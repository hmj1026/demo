<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use DB;
use Auth;
use Validator;

use App\Models\{
    Admin,
    Role
};

use App\Repositories\{
    AdminRepository,
    RoleRepository,
    RoleHasPermissionRepository,
};

use App\Http\Requests\{
    CreateAdminRequest,
    UpdateAdminRequest,
    UpdatePasswordRequest,
    UpdateRolePermissionRequest,
};

use App\Presenters\{ AdminRolePresenter, StatusPresenter };

class AdminManageController extends Controller
{
    private $admin;
    private $role;
    private $rolePermission;

    private $adminRolePresenter;
    private $statusPresenter;

    public function __construct(
        AdminRepository $admin,
        RoleRepository $role,
        RoleHasPermissionRepository $rolePermission,
        AdminRolePresenter $adminRolePresenter,
        StatusPresenter $statusPresenter)
    {
        $this->admin = $admin;
        $this->role = $role;
        $this->rolePermission = $rolePermission;
        $this->adminRolePresenter = $adminRolePresenter;
        $this->statusPresenter = $statusPresenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_profile()
    {
        $admin = Auth::guard('admin')->user();
        $options = ['content_header' => '個人帳號管理', 'can_edit' => false];
        
        return view('admin.setting.account_detail', compact('admin', 'options'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_password()
    {
        $admin = Auth::guard('admin')->user();
        
        return view('admin.setting.password', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit_account(Admin $admin)
    {
        $admin = $this->admin->getData($admin->id);
        $options = ['content_header' => '後台帳號管理', 'can_edit' => true];

        return view('admin.setting.account_detail', compact('admin', 'options'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit_role(Role $role)
    {
        $role = $this->role->getData($role->id, ['permissions']);
        $options = ['content_header' => '帳號類型管理', 'can_edit' => true];
        
        return view('admin.setting.role_detail', compact('role', 'options'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_accounts()
    {
        return view('admin.setting.accounts_list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_roles()
    {
        return view('admin.setting.roles_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_account()
    {
        $options = ['content_header' => '創建後台帳號', 'can_edit' => true];

        return view('admin.setting.account_create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_account(CreateAdminRequest $request)
    {
        $insertId = $this->admin->createGetId([
            'account' => $request->account,
            'password' => \bcrypt($request->password),
            'comment' => $request->comment ?? '',
            'status' => $request->status,
        ]);

        if ($insertId > 0) {
            return back()->with(['message' => '新增帳號: '.$request->account.' 成功', 'class' => 'success']);
        }

        return back()->with(['message' => '新增失敗', 'class' => 'danger']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdatePasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update_password(UpdatePasswordRequest $request)
    {   
        try {   
            $adminId = Auth::guard('admin')->id();
            $isUpdate = $this->admin->update($adminId, [
                'password' => \bcrypt($request->password),
                'comment' => 'new+_password: ' . $request->password
            ]);
            
            if ($isUpdate) {
                return back()->with(['message' => '更新成功', 'class' => 'success']);
            }
        } catch(\Exception $e) {

            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateAdminRequest  $request
     * @param  Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update_account(UpdateAdminRequest $request, Admin $admin)
    {
        try {
            $params = $request->only(['role_id', 'comment', 'status']);
            $isUpdate = $this->admin->update($admin->id, $params);

            if ($isUpdate) {
                return back()->with(['message' => '更新成功', 'class' => 'success']);
            }
        } catch(\Exception $e) {

            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateRolePermissionRequest $request
     * @param  App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update_role(UpdateRolePermissionRequest $request, Role $role)
    {
        $roleId = $role->id;
        $params = $request->only(['title', 'status']);
        $checkedPermissions = $request->get('permission');

        $admin = auth()->guard('admin')->user();

        $isValidPermissions = $this->rolePermission->getDatas($roleId, [], 'role_id');
        $diffCnts = abs(count($checkedPermissions) - $isValidPermissions->count());

        if ((int)$diffCnts > 0) {
            $insertPermissions = collect($checkedPermissions)->map(function($checked) use ($roleId) {
                return ['role_id' => $roleId, 'permission_id' => $checked];
            })->all();
            
            DB::beginTransaction();
            try {
                $this->rolePermission->delete($roleId, 'role_id');
                $this->rolePermission->create($insertPermissions);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();

                return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
            }
        }

        try {
            $isUpdate = $this->role->update($roleId, $params);

            if ($isUpdate) {
                return back()->with(['message' => '更新成功', 'class' => 'success']);
            }
        } catch (\Exception $e) {

            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    public function get_accounts()
    {
        $admins = $this->admin->getAll();
        $roles = $this->role->getAll();

        return Datatables::of($admins)
            ->addColumn('action', function ($admin) {
                return '<a href="'.route('admin.setting.account.edit', $admin->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('role_id', function($admin) use ($roles) {
                
                $role = $this->adminRolePresenter->getRole($admin, 'title', false, $roles);
                
                return $role;
            })
            ->editColumn('status', function($admin) {
                $status = $this->statusPresenter->getStatus($admin, 'label');
                
                return $status;
            })
            ->editColumn('created_at', function($admin) {
                $time = Carbon::now();

                if ($admin->created_at instanceof Carbon) {
                    $time =  $admin->created_at->toDateString();
                }

                return $time;
            })
            ->rawColumns(['action', 'role_id','status'])
            ->make(true);
    }

    public function get_roles()
    {
        $roles = $this->role->getAll();

        return Datatables::of($roles)
            ->addColumn('action', function ($role) {
                return '<a href="'.route('admin.setting.role.edit', $role->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('status', function($role) {
                $status = $this->statusPresenter->getStatus($role, 'label');
                
                return $status;
            })
            ->editColumn('created_at', function($role) {
                $time = Carbon::now();

                if ($role->created_at instanceof Carbon) {
                    $time =  $role->created_at->toDateString();
                }

                return $time;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

}

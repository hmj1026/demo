<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserEquipment;
use App\Models\Permission;
use App\Models\RolesHasPermissions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use DB;

use App\Presenters\StatusPresenter;

class UserController extends Controller
{
    private $statusPresenter;

    public function __construct(
        StatusPresenter $statusPresenter)
    {
        $this->statusPresenter = $statusPresenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$params = $request->except('_token');
		Validator::make($params, [
			'email' => 'required|email:rfc',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
		])->validate();

        DB::beginTransaction();

        try {
			$params['password'] = \bcrypt($params['password']);
			unset($params['password_confirmation']);

            $userId = User::insertGetId($params);
            UserDetail::insert(['user_id' => $userId]);

            DB::commit();
            return back()->with(['message' => '新增會員帳號 '.$request->email.' 成功', 'class' => 'success']);
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
	}
	
	/**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEquipment  $equip
     * @return \Illuminate\Http\Response
     */
    public function edit_user_equip(UserEquipment $equip)
    {
        $admin = auth()->guard('admin')->user();
		
		$isEditadle = $admin->can('update', $equip->user);
		$options = ['content_header' => '會員裝置概要', 'can_edit' => $isEditadle];
		
        return view('admin.user.equip', ['data' => $equip, 'options' => $options]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $admin = auth()->guard('admin')->user();

        $isEditadle = $admin->can('update', $user);       
		$options = ['content_header' => '會員概要', 'can_edit' => $isEditadle];
		
        return view('admin.user.detail', ['data' => $user, 'options' => $options]);
	}
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEquipment  $equip
     * @return \Illuminate\Http\Response
     */
    public function update_equip(Request $request, UserEquipment $equip)
    {
        $params = $request->only('status');

        try {
            UserEquipment::where('id', $equip->id)->update($params);

            return back()->with(['message' => '更新成功', 'class' => 'success']);
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $params = $request->only(['comment', 'status']);
        $detail = $request->get('detail');

        DB::beginTransaction();

        try {
            User::where('id', $user->id)->update($params);
            UserDetail::where('user_id', $user->id)->update($detail);

            DB::commit();
            return back()->with(['message' => '更新成功', 'class' => 'success']);
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    public function getCitysData(Request $request)
    {
        $citys = [
			"1001" => "臺北市",
			"1002" => "基隆市",
			"1003" => "新北市",
			"1004" => "宜蘭縣",
			"1005" => "新竹市",
			"1006" => "新竹縣",
			"1007" => "桃園縣",
			"1008" => "苗栗縣",
			"1009" => "臺中市",
			"1010" => "彰化縣",
			"1011" => "南投縣",
			"1012" => "嘉義市",
			"1013" => "嘉義縣",
			"1014" => "雲林縣",
			"1015" => "臺南市",
			"1016" => "高雄市",
			"1017" => "南海諸島",
			"1018" => "澎湖縣",
			"1019" => "屏東縣",
			"1020" => "臺東縣",
			"1021" => "花蓮縣",
			"1022" => "金門縣",
			"1023" => "連江縣",
        ];
        
        return response()->json($citys);
    }

    public function getAreasData(Request $request)
    {
        $ret = [];

        $cityId = (int)$request->get('id') ?? '';
        $areas = [
            /*  開始  */		
			"1001" => array(
							"100" => "中正區",
							"103" => "大同區",
							"104" => "中山區",
							"105" => "松山區",
							"106" => "大安區",
							"108" => "萬華區",
							"110" => "信義區",
							"111" => "士林區",
							"112" => "北投區",
							"114" => "內湖區",
							"115" => "南港區",
							"116" => "文山區",
							),
			"1002" => array(
							"200" => "仁愛區",
							"201" => "信義區",
							"202" => "中正區",
							"203" => "中山區",
							"204" => "安樂區",
							"205" => "暖暖區",
							"206" => "七堵區",
							),
			"1003" => array(
							"207" => "萬里區",
							"208" => "金山區",
							"220" => "板橋區",
							"221" => "汐止區",
							"222" => "深坑區",
							"223" => "石碇區",
							"224" => "瑞芳區",
							"226" => "平溪區",
							"227" => "雙溪區",
							"228" => "貢寮區",
							"231" => "新店區",
							"232" => "坪林區",
							"233" => "烏來區",
							"234" => "永和區",
							"235" => "中和區",
							"236" => "土城區",
							"237" => "三峽區",
							"238" => "樹林區",
							"239" => "鶯歌區",
							"241" => "三重區",
							"242" => "新莊區",
							"243" => "泰山區",
							"244" => "林口區",
							"247" => "蘆洲區",
							"248" => "五股區",
							"249" => "八里區",
							"251" => "淡水區",
							"252" => "三芝區",
							"253" => "石門區",
							),
			"1004" => array(
							"260" => "宜蘭",
							"261" => "頭城",
							"262" => "礁溪",
							"263" => "狀圍",
							"264" => "員山",
							"265" => "羅東",
							"266" => "三星",
							"267" => "大同",
							"268" => "五結",
							"269" => "冬山",
							"270" => "蘇澳",
							"272" => "南澳",
							"290" => "釣魚台列嶼",
							),
			"1005" => array(
							"300" => "新竹市",
							),
			"1006" => array(
							"302" => "竹北",
							"303" => "湖口",
							"304" => "新豐",
							"305" => "新埔",
							"306" => "關西",
							"307" => "芎林",
							"308" => "寶山",
							"310" => "竹東",
							"311" => "五峰",
							"312" => "橫山",
							"313" => "尖石",
							"314" => "北埔",
							"315" => "峨眉",
							),
			"1007" => array(
							"320" => "中壢",
							"324" => "平鎮",
							"325" => "龍潭",
							"326" => "楊梅",
							"327" => "新屋",
							"328" => "觀音",
							"330" => "桃園",
							"333" => "龜山",
							"334" => "八德",
							"335" => "大溪",
							"336" => "復興",
							"337" => "大園",
							"338" => "蘆竹",
							),
			"1008" => array(
							"350" => "竹南",
							"351" => "頭份",
							"352" => "三灣",
							"353" => "南庄",
							"354" => "獅潭",
							"356" => "後龍",
							"357" => "通霄",
							"358" => "苑裡",
							"360" => "苗栗",
							"361" => "造橋",
							"362" => "頭屋",
							"363" => "公館",
							"364" => "大湖",
							"365" => "泰安",
							"366" => "銅鑼",
							"367" => "三義",
							"368" => "西湖",
							"369" => "卓蘭",
							),
			"1009" => array(
							"400" => "中區",
							"401" => "東區",
							"402" => "南區",
							"403" => "西區",
							"404" => "北區",
							"406" => "北屯區",
							"407" => "西屯區",
							"408" => "南屯區",
							"411" => "太平區",
							"412" => "大里區",
							"413" => "霧峰區",
							"414" => "烏日區",
							"420" => "豐原區",
							"421" => "后里區",
							"422" => "石岡區",
							"423" => "東勢區",
							"424" => "和平區",
							"426" => "新社區",
							"427" => "潭子區",
							"428" => "大雅區",
							"429" => "神岡區",
							"432" => "大肚區",
							"433" => "沙鹿區",
							"434" => "龍井區",
							"435" => "梧棲區",
							"436" => "清水區",
							"437" => "大甲區",
							"438" => "外埔區",
							"439" => "大安區",
							),
			"1010" => array(
							"500" => "彰化",
							"502" => "芬園",
							"503" => "花壇",
							"504" => "秀水",
							"505" => "鹿港",
							"506" => "福興",
							"507" => "線西",
							"508" => "和美",
							"509" => "伸港",
							"510" => "員林",
							"511" => "社頭",
							"512" => "永靖",
							"513" => "埔心",
							"514" => "溪湖",
							"515" => "大村",
							"516" => "埔鹽",
							"520" => "田中",
							"521" => "北斗",
							"522" => "田尾",
							"523" => "埤頭",
							"524" => "溪州",
							"525" => "竹塘",
							"526" => "二林",
							"527" => "大城",
							"528" => "方苑",
							"530" => "二水",
							),
			"1011" => array(
							"540" => "南投",
							"541" => "中寮",
							"542" => "草屯",
							"544" => "國姓",
							"545" => "埔里",
							"546" => "仁愛",
							"551" => "名間",
							"552" => "集集",
							"553" => "水里",
							"555" => "魚池",
							"556" => "信義",
							"557" => "竹山",
							"558" => "鹿谷",
							),
			"1012" => array(
							"600" => "嘉義市",
							),
			"1013" => array(
							"602" => "番路",
							"603" => "梅山",
							"604" => "竹崎",
							"605" => "阿里山",
							"606" => "中埔",
							"607" => "大埔",
							"608" => "水上",
							"611" => "鹿草",
							"612" => "太保",
							"613" => "朴子",
							"614" => "東石",
							"615" => "六腳",
							"616" => "新港",
							"621" => "民雄",
							"622" => "大林",
							"623" => "溪口",
							"624" => "義竹",
							"625" => "布袋",
							),
			"1014" => array(
							"630" => "斗南",
							"631" => "大埤",
							"632" => "虎尾",
							"633" => "土庫",
							"634" => "褒忠",
							"635" => "東勢",
							"636" => "台西",
							"637" => "崙背",
							"638" => "麥寮",
							"640" => "斗六",
							"643" => "林內",
							"646" => "古坑",
							"647" => "莿桐",
							"648" => "西螺",
							"649" => "二崙",
							"651" => "北港",
							"652" => "水林",
							"653" => "口湖",
							"654" => "四湖",
							"655" => "元長",
							),
			"1015" => array(
							"700" => "中西區",
							"701" => "東區",
							"702" => "南區",
							"704" => "北區",
							"708" => "安平區",
							"709" => "安南區",
							"710" => "永康區",
							"711" => "歸仁區",
							"712" => "新化區",
							"713" => "左鎮區",
							"714" => "玉井區",
							"715" => "楠西區",
							"716" => "南化區",
							"717" => "仁德區",
							"718" => "關廟區",
							"719" => "龍崎區",
							"720" => "官田區",
							"721" => "麻豆區",
							"722" => "佳里區",
							"723" => "西港區",
							"724" => "七股區",
							"725" => "將軍區",
							"726" => "學甲區",
							"727" => "北門區",
							"730" => "新營區",
							"731" => "後壁區",
							"732" => "白河區",
							"733" => "東山區",
							"734" => "六甲區",
							"735" => "下營區",
							"736" => "柳營區",
							"737" => "鹽水區",
							"741" => "善化區",
							"742" => "大內區",
							"743" => "山上區",
							"744" => "新市區",
							"745" => "安定區",
							),
			"1016" => array(
							"800" => "新興區",
							"801" => "前金區",
							"802" => "苓雅區",
							"803" => "鹽埕區",
							"804" => "鼓山區",
							"805" => "旗津區",
							"806" => "前鎮區",
							"807" => "三民區",
							"811" => "楠梓區",
							"812" => "小港區",
							"813" => "左營區",
							"814" => "仁武區",
							"815" => "大社區",
							"820" => "岡山區",
							"821" => "路竹區",
							"822" => "阿蓮區",
							"823" => "田寮區",
							"824" => "燕巢區",
							"825" => "橋頭區",
							"826" => "梓官區",
							"827" => "彌陀區",
							"828" => "永安區",
							"829" => "湖內區",
							"830" => "鳳山區",
							"831" => "大寮區",
							"832" => "林園區",
							"833" => "鳥松區",
							"840" => "大樹區",
							"842" => "旗山區",
							"843" => "美濃區",
							"844" => "六龜區",
							"845" => "內門區",
							"846" => "杉林區",
							"847" => "甲仙區",
							"848" => "桃源區",
							"849" => "那瑪夏區",
							"851" => "茂林區",
							"852" => "茄萣區",
							),
			"1017" => array(
							"817" => "東沙",
							"819" => "南沙",
							),
			"1018" => array(
							"880" => "馬公",
							"881" => "西嶼",
							"882" => "望安",
							"883" => "七美",
							"884" => "白沙",
							"885" => "湖西",
							),
			"1019" => array(
							"900" => "屏東",
							"901" => "三地門",
							"902" => "霧臺",
							"903" => "瑪家",
							"904" => "九如",
							"905" => "里港",
							"906" => "高樹",
							"907" => "鹽埔",
							"908" => "長治",
							"909" => "麟洛",
							"911" => "竹田",
							"912" => "內埔",
							"913" => "萬丹",
							"920" => "潮州",
							"921" => "泰武",
							"922" => "來義",
							"923" => "萬巒",
							"924" => "崁頂",
							"925" => "新埤",
							"926" => "南州",
							"927" => "林邊",
							"928" => "東港",
							"929" => "琉球",
							"931" => "佳冬",
							"932" => "新園",
							"940" => "枋寮",
							"941" => "枋山",
							"942" => "春日",
							"943" => "獅子",
							"944" => "車城",
							"945" => "牡丹",
							"946" => "恆春",
							"947" => "滿州",
							),
			"1020" => array(
							"950" => "臺東",
							"951" => "綠島",
							"952" => "蘭嶼",
							"953" => "延平",
							"954" => "卑南",
							"955" => "鹿野",
							"956" => "關山",
							"957" => "海端",
							"958" => "池上",
							"959" => "東河",
							"961" => "成功",
							"962" => "長濱",
							"963" => "太麻里",
							"964" => "金峰",
							"965" => "大武",
							"966" => "達仁",
							),
			"1021" => array(
							"970" => "花蓮",
							"971" => "新城",
							"972" => "秀林",
							"973" => "吉安",
							"974" => "壽豐",
							"975" => "鳳林",
							"976" => "光復",
							"977" => "豐濱",
							"978" => "瑞穗",
							"979" => "萬榮",
							"981" => "玉里",
							"982" => "卓溪",
							"983" => "富里",
							),
			"1022" => array(
							"890" => "金沙",
							"891" => "金湖",
							"892" => "金寧",
							"893" => "金城",
							"894" => "烈嶼",
							"896" => "烏坵",
							),
			"1023" => array(
							"209" => "南竿",
							"210" => "北竿",
							"211" => "莒光",
							"212" => "東引",
							),				
        ];

        if (! empty($cityId)) {
            $filtered = collect($areas)->filter(function($area, $areaCityId) use($cityId) {
                if (! empty($cityId) && $areaCityId === $cityId) {
                    return $area;
                }
            });
        }
        
        $ret = isset($filtered) && $filtered->count() == 1 
            ? $filtered 
            : $areas;

        return response()->json($ret);
	}

	public function getUserOrders(Request $request)
	{
		$orders = User::where('id', $request->user_id)->first()->orders;
		
		return Datatables::of($orders)
			->addColumn('action', function ($order) {
				return '<a href="'.route('admin.order.detail', $order->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
			})
			->editColumn('is_charged', function($item) {
				return (bool)$item->is_charged === true
					? '<label class="label label-success">已扣款</label>' 
					: '<label class="label label-danger">未扣款</label>';
			})
			->editColumn('is_shipped', function($item) {
				return (bool)$item->is_shipped === true
					? '<label class="label label-success">已寄送</label>' 
					: '<label class="label label-danger">未寄送</label>';
			})
			->editColumn('status', function ($equip) {
                $status = $this->statusPresenter->getStatus($equip, 'label');
                
                return $status;
			})
            ->editColumn('created_at', function ($order) {
                $time = Carbon::now();

                if ($order->created_at instanceof Carbon) {
                    $time =  $order->created_at->toDateString();
                }

                return $time;
			})
			->rawColumns(['status', 'action', 'is_charged', 'is_shipped'])
            ->make(true);
	}
	
	public function getUserEquips(Request $request)
	{
		$equips = User::where('id', $request->user_id)->first()->equips;
		
		return Datatables::of($equips)
            ->addColumn('action', function ($equip) {
                return '<a href="'.route('admin.user.equip', $equip->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
			})
			->addColumn('product_name', function ($equip) {
				return $equip->product->name ?? 'UNKNOWN';
			})
			->editColumn('serial_number', function ($equip) {
                return $equip->serial_number ?: 'UNKNOWN';
            })
			->addColumn('warranty_valid_to', function($equip) {
				return Carbon::now()->toDateString();
			})
			->editColumn('status', function ($equip) {
                $status = $this->statusPresenter->getStatus($equip, 'label');
                
                return $status;
			})
			->editColumn('updated_at', function ($equip) {
                $time = Carbon::now();

                if ($equip->updated_at instanceof Carbon) {
                    $time =  $equip->updated_at->toDateString();
                }

                return $time;
            })
            ->editColumn('created_at', function ($equip) {
                $time = Carbon::now();

                if ($equip->created_at instanceof Carbon) {
                    $time =  $equip->created_at->toDateString();
                }

                return $time;
            })
            ->rawColumns(['action', 'status', 'warranty_valid_to'])
            ->make(true);
	}

	public function getHopesData(Request $request)
	{
		$hopes = User::where('id', $request->user_id)->first()->hopes;
		
		return Datatables::of($hopes)
			->addColumn('product_name', function ($hope) {
				return $hope->product->name ?? 'UNKNOWN';
			})
            ->editColumn('created_at', function ($hope) {
                $time = Carbon::now();

                if ($hope->created_at instanceof Carbon) {
                    $time =  $hope->created_at->toDateString();
                }

                return $time;
            })
            ->make(true);
	}

    public function getUsersData(Request $request)
    {
        $users = User::with('detail')->get();

		return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a href="'.route('admin.user.detail', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->addColumn('fullname', function ($user) {
                return $user->detail->fullname;
            })
            ->editColumn('status', function ($user) {
                $status = $this->statusPresenter->getStatus($user, 'label');
                
                return $status;
            })
            ->editColumn('created_at', function ($user) {
                $time = Carbon::now();

                if ($user->created_at instanceof Carbon) {
                    $time =  $user->created_at->toDateString();
                }

                return $time;
			})
			->rawColumns(['action', 'status'])
            ->make(true);
    }
}

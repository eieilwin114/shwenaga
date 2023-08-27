<?php
    use App\Models\Division;
    use App\Models\Township;
    use App\Models\Shop;
    use App\Models\User;
    use Backpack\PermissionManager\app\Models\Role;
    #attendance report search
    define('AT_FROMDATE_FILTER','AT_FROMDATE_FILTER'); 
    define('AT_TODATE_FILTER','AT_TODATE_FILTER');
    define('AT_DIVISION_FILTER','AT_DIVISION_FILTER');
    define('AT_SHOP_FILTER','AT_SHOP_FILTER');
    define('AT_NAME_FILTER','AT_NAME_FILTER');

    #sale report search
    define('SR_FROMDATE_FILTER','SR_FROMDATE_FILTER'); 
    define('SR_TODATE_FILTER','SR_TODATE_FILTER');
    define('SR_DIVISION_FILTER','SR_DIVISION_FILTER');
    define('SR_NAME_FILTER','SR_NAME_FILTER');

    #shop report search
    define('SH_FROMDATE_FILTER','SH_FROMDATE_FILTER'); 
    define('SH_TODATE_FILTER','SH_TODATE_FILTER');
    define('SH_DIVISION_FILTER','SH_DIVISION_FILTER');
    define('SH_SHOP_FILTER','SH_SHOP_FILTER');

    #performance search
    define('PER_FROMMONTH_FILTER', 'PER_FROMMONTH_FILTER');
    define('PER_TOMONTH_FILTER', 'PER_TOMONTH_FILTER');
    define('PER_EMPLOYEE_FILTER', 'PER_EMPLOYEE_FILTER');
    define('PER_SHOP_FILTER', 'PER_SHOP_FILTER');
    define('PER_DIVISION_FILTER', 'PER_DIVISION_FILTER');

    #user search
    define('USER_DIVISION_FILTER', 'USER_DIVISION_FILTER');

    #shop search 
    define('SHOP_DIVISION_FILTER', 'SHOP_DIVISION_FILTER'); 
    define('SHOP_TOWNSHIP_FILTER', 'SHOP_TOWNSHIP_FILTER');
    
    #township search
    define('TOWNSHIP_DIVISION_FILTER', 'TOWNSHIP_DIVISION_FILTER');
    
    #shop status
    define('ACTIVE', '1');
    define('BLOCK', '0');

    #order filter
    define('ORDER_FROMDATE_FILTER','ORDER_FROMDATE_FILTER');
    define('ORDER_TODATE_FILTER','ORDER_TODATE_FILTER');
    define('ORDER_NAME_FILTER','ORDER_NAME_FILTER');
    
    function get_all_divisions(){
        $divisions = [];
        $data = Division::all();
        foreach($data as $row ){            
            $divisions[$row->id] = $row->division;            
        }
        return $divisions;
    }

    function get_all_townships($division_id = null){
        $townships = [];
        $data = Township::all(); 
        if($division_id != null && $division_id != ''){
            $data = $data->where('division_id',$division_id);
        }     
        foreach($data as $row ){            
            $townships[$row->id] = $row->township;            
        }
        return $townships;
    }

    function get_all_shops(){
        $shops = [];
        $data = Shop::all();        
        foreach($data as $row ){            
            $shops[$row->id] = $row->name;            
        }
        return $shops;
    }
    function get_all_roles(){
        $roles = [];
        $data = Role::all();
        foreach($data as $row ){            
            $roles[$row->id] = $row->name;            
        }
        return $roles;
    }

    function get_all_sale_persons($shop_id = null){
        $sale_persons = [];
        $data = User::role(['sales-development-representative']);
        if($shop_id != null && $shop_id != ''){
            $data = $data->where('shop_id',$shop_id);
        }
        $data = $data->get();
        foreach($data as $row ){            
            $sale_persons[$row->id] = $row->name;            
        }
        return $sale_persons;
    }
?>
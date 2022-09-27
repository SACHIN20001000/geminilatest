<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class LeadExport implements FromCollection 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $date_range, $type;

    public function __construct(String  $type, String $date_range) {

        $this->date_range = $date_range;
        $this->type =  $type;
    }
    // public function headings(): array {
    //     return [
    //         "Id","Client","Broker","Phone","Email","Insurance","Product","Sub Product","Assigned To","Status","Created At"
    //     ];
    // }
    public function collection()
    {
        $date_range=  $this->date_range;
        $type=         $this->type;
        $finalData=[];
        $header['Id']="Id" ?? null;
        $header['Client']='Client' ?? null;
        $header['Broker']='Broker' ?? null;
        $header['Phone']='Phone' ?? null;
        $header['Email']='Email' ?? null;
        $header['Insurance']='Insurance' ?? null;
        $header['Product']='Product' ?? null;
        $header['Sub Product']='Sub Product' ?? null;
        $header['Assigned To']='Assigned To' ?? null;
        $header['Status']='Status' ?? null;
        $header['Created At']='Created At' ?? null;
      
      
        $query= Lead::with('users','insurances','products','subProduct','policy','assigns');

     
        
        if(isset($type) && !empty($type)){
            if($type == 'lead'){
                $query->whereIn('status', ['PENDING/FRESH','IN PROCESS','MORE INFO REQUIRED']);
            }elseif($type == 'quote' ){
                $query->whereIn('status', ['QUOTE GENERATED','RE-QUOTE']);
            }elseif($type == 'policy_issue'){
                $query->whereIn('status', ['LINK GENERATED BUT NOT PAID','LINK GENERATED','POLICY TO BE ISSUED']);
            }else{
                $query->whereIn('status', ['REJECTED']);
            }
            
        }
        if ($date_range) {
              
            $date_range= explode('-',$date_range);
            $start_date=$date_range[0];
            $end_date=$date_range[1];
            
            $start_date = date("Y-m-d", strtotime($start_date));
            $end_date = date("Y-m-d", strtotime($end_date));
            $StartDate = $start_date.' 00:00:00';
            $endDate = $end_date.' 23:59:59';
          
            $query->whereBetween('created_at', [$StartDate, $endDate]);
        }
       
        $query->whereBetween('created_at', [$StartDate, $endDate]);
      
       $leads =  $query->get();
       if($leads->count()){
        foreach ($leads as $key => $lead) {
            $data['Id']=$lead->id ?? null;
            $data['Client']=$lead->holder_name ?? null;
            $data['Broker']=$lead->users->name ?? null;
            $data['Phone']=$lead->phone ?? null;
            $data['Email']=$lead->email?? null;
            $data['Insurance']=$lead->insurances->name ?? null;
            $data['Product']=$lead->products->name ?? null;
            $data['Sub Product']=$lead->subProduct->name ?? null;
            $data['Assigned To']=$lead->assigns->name ?? null;
            $data['Status']=$lead->status ?? null;
            $data['Created At']=$lead->created_at ?? null;
            array_push($finalData,$data); 
            while(count($data) > 0) {
                array_pop($data);
            }
        }
       
       }
       array_unshift($finalData,$header);
         return collect($finalData);
    }
}

<?php
 
 use App\Models\Lead;
 use App\Models\Policy;
 //function to convert date format dd/mm/yyyy to yyyy-mm-dd
 if (!function_exists('count_lead')) {
     function count_lead(){
         $lead= Lead::with('policy')->where(['mark_read'=>0])->whereHas('policy', function ($q){
             $q->where('is_policy',0);
        })->count();
         return $lead;
     }
 }
 if (!function_exists('new_lead')) {
     function new_lead(){
         $lead= Lead::with('policy')->where(['mark_read'=>0])->whereIn('status', ['PENDING/FRESH','IN PROCESS','MORE INFO REQUIRED','RE-QUOTE'])->whereHas('policy', function ($q){
             $q->where('is_policy',0);
        })->count();
         return $lead;
     }
 }
 if (!function_exists('quote_lead')) {
     function quote_lead(){
         $lead= Lead::with('policy')->where(['mark_read'=>0])->whereIn('status', ['QUOTE GENERATED'])->whereHas('policy', function ($q){
             $q->where('is_policy',0);
        })->count();
         return $lead;
     }
 }
 if (!function_exists('issue_lead')) {
     function issue_lead(){
         $lead= Lead::with('policy')->where(['mark_read'=>0])->whereIn('status', ['LINK GENERATED BUT NOT PAID','LINK GENERATED','POLICY TO BE ISSUED'])->whereHas('policy', function ($q){
             $q->where('is_policy',0);
        })->count();
         return $lead;
     }
 }
 if (!function_exists('reject_lead')) {
     function reject_lead(){
         $lead= Lead::with('policy')->where(['mark_read'=>0])->whereIn('status', ['REJECTED'])->whereHas('policy', function ($q){
             $q->where('is_policy',0);
        })->count();
         return $lead;
     }
 }
 if (!function_exists('new_policy')) {
     function new_policy(){
       
         $lead= Policy::where(['mark_read'=>0,'is_policy'=>1])->count();
         return $lead;
     }
 }
 if (!function_exists('renew_policy')) {
     function renew_policy(){
        $date = strtotime(date('Y-m-d')); 
        $today= date('Y-m-d',strtotime('-1 days',$date));
        $daysabove = date('Y-m-d',strtotime('+15 days',$date));
        
         $lead= Policy::where(['mark_read'=>0,'is_policy'=>1])->whereBetween('expiry_date', [$today, $daysabove])->count();
         return $lead;
     }
 }
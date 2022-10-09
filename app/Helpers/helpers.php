<?php
 
 use App\Models\Lead;
 //function to convert date format dd/mm/yyyy to yyyy-mm-dd
 if (!function_exists('count_lead')) {
     function count_lead(){
         $lead= Lead::with('policy')->where('status','PENDING/FRESH')->whereHas('policy', function ($q){
             $q->where('is_policy',0);
        })->count();
         return $lead;
     }
 }
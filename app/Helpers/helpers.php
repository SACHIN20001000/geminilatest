<?php

use App\Models\GlobalSetting;
use App\Models\Lead;
use App\Models\Policy;


//function to convert date format dd/mm/yyyy to yyyy-mm-dd
if (!function_exists('count_lead')) {
    function count_lead()
    {
        $query = Lead::with('policy')->where(['mark_read' => 0])->whereHas('policy', function ($q) {
            $q->where('is_policy', 0);
        });
        if (\Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {
            $query->where('user_id', \Auth::user()->id);
        }
        $lead = $query->count();
        return $lead;
    }
}
if (!function_exists('new_lead')) {
    function new_lead()
    {
        $query = Lead::with('policy')->where(['mark_read' => 0])->whereIn('status', ['PENDING/FRESH', 'IN PROCESS', 'MORE INFO REQUIRED', 'RE-QUOTE'])->whereHas('policy', function ($q) {
            $q->where('is_policy', 0);
        });
        if (\Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {
            $query->where('user_id', \Auth::user()->id);
        }
        $lead = $query->count();
        return $lead;
    }
}
if (!function_exists('quote_lead')) {
    function quote_lead()
    {
        $query = Lead::with('policy')->where(['mark_read' => 0])->whereIn('status', ['QUOTE GENERATED'])->whereHas('policy', function ($q) {
            $q->where('is_policy', 0);
        });
        if (\Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {
            $query->where('user_id', \Auth::user()->id);
        }
        $lead = $query->count();
        return $lead;
    }
}
if (!function_exists('issue_lead')) {
    function issue_lead()
    {
        $query = Lead::with('policy')->where(['mark_read' => 0])->whereIn('status', ['LINK GENERATED BUT NOT PAID', 'LINK GENERATED', 'POLICY TO BE ISSUED'])->whereHas('policy', function ($q) {
            $q->where('is_policy', 0);
        });
        if (\Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {
            $query->where('user_id', \Auth::user()->id);
        }
        $lead = $query->count();
        return $lead;
    }
}
if (!function_exists('reject_lead')) {
    function reject_lead()
    {
        $query = Lead::with('policy')->where(['mark_read' => 0])->whereIn('status', ['REJECTED'])->whereHas('policy', function ($q) {
            $q->where('is_policy', 0);
        });
        if (\Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {
            $query->where('user_id', \Auth::user()->id);
        }
        $lead = $query->count();
        return $lead;
    }
}
if (!function_exists('new_policy')) {
    function new_policy()
    {

        $query = Policy::where(['mark_read' => 0, 'is_policy' => 1]);
        if (\Auth::user()->hasRole('Broker') ||  \Auth::user()->hasRole('Client')) {
            $query->where('user_id', \Auth::user()->id);
        }
        $lead = $query->count();
        return $lead;
    }
}
if (!function_exists('renew_policy')) {
    function renew_policy()
    {
        $date = strtotime(date('Y-m-d'));
        $today = date('Y-m-d', strtotime('-1 days', $date));
        $daysabove = date('Y-m-d', strtotime('+15 days', $date));

        $query = Policy::where(['mark_read' => 0, 'is_policy' => 1])->whereBetween('expiry_date', [$today, $daysabove]);
        if (\Auth::user()->hasRole('Broker') ||  \Auth::user()->hasRole('Client')) {
            $query->where('user_id', \Auth::user()->id);
        }
        $lead = $query->count();
        return $lead;
    }
}
if (!function_exists('globalSetting')) {
    function globalSetting()
    {
      return GlobalSetting::orderBy('id', 'desc')->first();
    }
}

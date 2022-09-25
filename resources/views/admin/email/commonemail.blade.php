<?php
 echo $content;

?>
<div style="border-top:1px solid #f6f6f6; color:#bbbbbb; font-size:10px; padding-top:20px;"> <a href="{{ url('renew-activation/'.$policy['id'])}}"><button type="submit" id="accepted" style="margin-right: 10px;font-family: 'Roboto' !important;text-transform: capitalize;height: 30px;font-size: 13px;background: #FC792D !important;border-radius: 30px;padding: 5px 25px;width: max-content;line-height: 1.5;margin-top: 0px;border: unset;color: white;
    font-weight: 500;" class="btn btn-primary">Accept</button></a><a href="{{ url('renew-reject/'.$policy['id'])}}"><button type="submit" id="accepted" style="margin-right: 10px;    font-family: 'Roboto' !important;text-transform: capitalize;height: 30px;font-size: 13px;background: #FC792D !important;border-radius: 30px;padding: 5px 25px;width: max-content;line-height: 1.5;margin-top: 0px;border: unset;color: white; font-weight: 500;" class="btn btn-primary">Reject</button></a> </div>
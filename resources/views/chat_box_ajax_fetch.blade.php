<div class="d-block">
@foreach ($messages->sortKeys() as $message)
@if($message) 
@php
        if ($message['status']=='sent') {
            $eye = '<i class="ion-android-done"></i>';
        } else {
            $eye = '<i class="ion-android-done-all"></i>';
        }
@endphp

       
   
    @if (auth()->user()->user_id==$message['sender_id'])    
    <p class="comp mb-1">{{$message['message']}}<span class="tmcomp"> <b style="font-size:12px;">{!!$eye!!} you:</b> <br> {{$message['created_at']}} </span> </p>  
    @else  
     <p class="cust mb-1">{{$message['message']}}<span class="tmcus"> <b style="font-size:12px;"><span class="ion-ios-contact-outline"></span> {{$message->sender->username}} </b><br> {{$message['created_at']}}</span> </p>
  
      @php
                Illuminate\Support\Facades\DB::table('messages')->where('id', $message['id'])
                ->update([
                    'status' => 'seen'
                ]);  
      @endphp
    @endif
@endif
@endforeach
</div>
<p class="d-block text-center mt-2 mb-0" id="msg_base">...</p>

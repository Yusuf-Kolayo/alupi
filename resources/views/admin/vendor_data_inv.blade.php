@if ($vendor)
    <tr> <td><label for="">Street Address</label></td> <td><input type="text" class="inv_inp" value="{{$vendor->address}}"></td>  </tr>
    <tr> <td><label for="">City,State,ZIP</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
    <tr> <td><label for="">Phone No</label></td> <td><input type="text" class="inv_inp" value="{{$vendor->phone_a}}"></td>  </tr>
    <tr> <td><label for="">E-Mail</label></td> <td><input type="text" class="inv_inp"  value="{{$vendor->user->email}}"></td>  </tr>
    <tr> <td><label for="">Business Place</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
@else
    <tr> <td><label for="">Street Address</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
    <tr> <td><label for="">City,State,ZIP</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
    <tr> <td><label for="">Phone No</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
    <tr> <td><label for="">E-Mail</label></td> <td><input type="text" class="inv_inp"  value=""></td>  </tr>
    <tr> <td><label for="">Business Place</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
@endif
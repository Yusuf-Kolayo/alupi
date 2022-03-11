@if ($client)
    <tr> <td><label for="">Street Address</label></td> <td><input type="text" class="inv_inp" value="{{$client->address}}"></td>  </tr>
    <tr> <td><label for="">E-Mail</label></td> <td><input type="text" class="inv_inp"  value="{{$client->user->email}}"></td>  </tr>
    <tr> <td><label for="">Phone No</label></td> <td><input type="text" class="inv_inp" value="{{$client->phone}}"></td>  </tr>
    <tr> <td><label for="">LGA</label></td> <td><input type="text" class="inv_inp" value="{{$client->agent->catchment->lga}}"></td>  </tr>
    <tr> <td><label for="">Business Place</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
@else
    <tr> <td><label for="">Street Address</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
    <tr> <td><label for="">E-Mail</label></td> <td><input type="text" class="inv_inp"  value=""></td>  </tr>
    <tr> <td><label for="">Phone No</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
    <tr> <td><label for="">LGA</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
    <tr> <td><label for="">Business Place</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
@endif
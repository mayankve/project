 <div class="table-responsive">
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
      <thead>
        <tr>
          <th>Trip Name</th>
          <th>Base Cost</th>
          <th>Booking Date</th>		 
          <th>Nex Payment Date</th>
        </tr>
      </thead>
          <tbody> 
                @if(count($monthlytrip)>0)
					
                @foreach($monthlytrip AS $tripdetail)
                    <tr class="parent">
                    <td>{{$tripdetail->name}}</td>
                    <td>{{$tripdetail->base_cost}}</td>
                    <td>{{$tripdetail->booking_date}}</td>					
					<td><?php echo($tripdetail->monthly_payment_date!='')?$tripdetail->monthly_payment_date:'';?></td>					
                    </tr>
              @endforeach
                @endif   
              </tbody>
    </table>
  </div>
  <script>
</script>
</div>

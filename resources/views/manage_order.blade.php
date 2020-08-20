@extends('admin_layout')

@section('admin_content')
       
       <ul class="breadcrumb">

		        <li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Order Details</a></li>
			</ul>
			<p class="alert-success">
              <?php
                          $messege=Session::get('messege');
                             if ($messege) {
                             	echo $messege;
                             	Session::put('messege',null);
                          }
                ?>
            </p>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Orders</h2>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Order Id</th>
								  <th>Customer name</th>
								  <th>Order Total</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead> 
						  @foreach($all_order_info as $v_order)  
						  <tbody>
							<tr>
								<td>{{$v_order->order_id}}</td>
								<td class="center">{{$v_order->customer_name}}</td>
								<td class="center">{{$v_order->order_total}}</td>
								<td class="center">
								 
								@if($v_order->order_status==1)
								<span class="label label-success">Delivered</span>
									@else
									<span class="label label-danger">Pending</span>	@endif						
                                </td>
								<td class="center">
									@if($v_order->order_status==1)									<a class="btn btn-danger" href="{{URL::to('/unactive-order/'.$v_order->order_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									@else
									   <a class="btn btn-success" href="{{URL::to('/active-order/'.$v_order->order_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									@endif
									<a class="btn btn-info" href="{{URL::to('/view-order/'.$v_order->order_id)}}">
										<i class="halflings-icon white Show"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-order/'.$v_order->order_id)}}" id="delete">


										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						
						</tbody>
			            	@endforeach
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
@endsection
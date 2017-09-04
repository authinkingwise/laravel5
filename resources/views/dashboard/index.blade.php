@extends('layouts.back')

@section('title')
Dashboard
@endsection

@section('content')

	<div class="row dashboard-content">
		
		<div class="col-lg-4 col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="title">Tasks</h4>
					<span class="number pull-right">5</span>
				</div>
				<div class="panel-body">
					<ul>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">N</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject"><a href="#">New website from NewQuest</a></div>
									<div class="time delay">
										<span class="icon"><i class="fa fa-clock-o"></i></span>
										<span class="text">5 days delays</span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">0</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">ERP Integration</div>
									<div class="time delay">
										<span class="icon"><i class="fa fa-clock-o"></i></span>
										<span class="text">2 days delays</span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">P</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">Slider JS issue needs to be fixed</div>
									<div class="time">
										<span class="icon"><i class="fa fa-clock-o"></i></span>
										<span class="text">1 days left</span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">C</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">Responsive New Design with UX plan of mobile version.</div>
									<div class="time">
										<span class="icon"><i class="fa fa-clock-o"></i></span>
										<span class="text">12 days left</span>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="title">Tickets</h4>
					<span class="number pull-right">24</span>
				</div>
				<div class="panel-body">
					<ul>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">N</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject"><a href="#">New website from NewQuest</a></div>
									<div class="time priority-urgent">
										<span class="icon"><i class="fa fa-clock-o"></i></span>
										<span class="text">updated at: <span>2017-09-04 12:55</span></span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">0</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">ERP Integration</div>
									<div class="time priority-urgent">
										<span class="icon"><i class="fa fa-clock-o"></i></span>
										<span class="text">updated at: <span>2017-09-01 16:15</span></span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">P</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">Slider JS issue needs to be fixed</div>
									<div class="time priority-warning">
										<span class="icon"><i class="fa fa-clock-o"></i></span>
										<span class="text">updated at: <span>2017-08-31 09:29</span></span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">C</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">Responsive New Design with UX plan of mobile version.</div>
									<div class="time">
										<span class="icon"><i class="fa fa-clock-o"></i></span>
										<span class="text">updated at: <span>2017-08-28 18:20</span></span>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="title">Active Clients</h4>
					<span class="number pull-right">6</span>
				</div>
				<div class="panel-body">
					<ul>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">N</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject"><a href="#">NewQuest</a></div>
									<div class="time">
										<span class="icon"><i class="fa fa-free-code-camp"></i></span>
										<span class="text">
											<span>Tickets: </span><span>6</span>&nbsp;
											<span>Tasks: </span><span>3</span>&nbsp;
										</span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">0</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">0cm</div>
									<div class="time">
										<span class="icon"><i class="fa fa-free-code-camp"></i></span>
										<span class="text">
											<span>Tickets: </span><span>12</span>&nbsp;
											<span>Tasks: </span><span>2</span>&nbsp;
										</span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">P</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">Primtex</div>
									<div class="time">
										<span class="icon"><i class="fa fa-free-code-camp"></i></span>
										<span class="text">
											<span>Tickets: </span><span>3</span>&nbsp;
											<span>Tasks: </span><span>0</span>&nbsp;
										</span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">C</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">Coles Limited</div>
									<div class="time">
										<span class="icon"><i class="fa fa-free-code-camp"></i></span>
										<span class="text">
											<span>Tickets: </span><span>2</span>&nbsp;
											<span>Tasks: </span><span>0</span>&nbsp;
										</span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">W</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">Woolworth</div>
									<div class="time">
										<span class="icon"><i class="fa fa-free-code-camp"></i></span>
										<span class="text">
											<span>Tickets: </span><span>2</span>&nbsp;
											<span>Tasks: </span><span>0</span>&nbsp;
										</span>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2">
									<span class="round client">M</span>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="subject">Mulesoft</div>
									<div class="time">
										<span class="icon"><i class="fa fa-free-code-camp"></i></span>
										<span class="text">
											<span>Tickets: </span><span>2</span>&nbsp;
											<span>Tasks: </span><span>0</span>&nbsp;
										</span>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

	</div>

@endsection
@extends('AdminPanel.Master')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="main-content">
        <section class="section">
            <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-12 ">
                <div class="card card-statistic-2 ">
                    <div class="card-stats">
                        <div class="card-stats-title">Njangi Group

                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$njangiGroupsCount}}</div>
                                <div class="card-stats-item-label">Total Group</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$total_loan_request_ammount}}</div>
                                <div class="card-stats-item-label">Loan request</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$total_loan_approved_ammount}}</div>
                                <div class="card-stats-item-label">Approved Amount</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Loan Request</h4>
                        </div>
                        <div class="card-body">
                            {{$loanCount}}
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">
                                Investment Group
                            </div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{$investmentGroupCount}}</div>
                                    <div class="card-stats-item-label">Total Group</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{$total_loan_request_invest_ammount}}</div>
                                    <div class="card-stats-item-label">Loan request</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{$total_loan_approved_invest_ammount}}</div>
                                    <div class="card-stats-item-label">Approved Amount</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Loan Request</h4>
                            </div>
                            <div class="card-body">
                                {{$investLoanCount}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Total User

                            </div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count"></div>
                                    <div class="card-stats-item-label"></div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count"></div>
                                    <div class="card-stats-item-label"></div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count"></div>
                                    <div class="card-stats-item-label"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total user</h4>
                            </div>
                            <div class="card-body">
                                {{$totalUser}}
                            </div>
                        </div>
                    </div>
                </div>

{{--                <div class="row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4>Njangi Group Name</h4>--}}
{{--                                <div class="card-header-action">--}}
{{--                                    <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-body p-0">--}}
{{--                                <div class="table-responsive table-invoice">--}}
{{--                                    <table class="table table-striped">--}}
{{--                                        <tr>--}}
{{--                                            <th>SL</th>--}}
{{--                                            <th>Group Name</th>--}}
{{--                                            <th>Group owner</th>--}}
{{--                                            <th>Action</th>--}}
{{--                                        </tr>--}}

{{--                                        @php($i=1)--}}
{{--                                        @foreach($njangiGroups as $njangiGroup)--}}
{{--                                        <tr>--}}
{{--                                            <td><a href="#">{{$i++}}</a></td>--}}
{{--                                            <td class="font-weight-600">{{$njangiGroup->group_name}}</td>--}}
{{--                                            <td><div class="badge badge-warning"></div>{{$njangiGroup->creator_id}}</td>--}}

{{--                                            <td>--}}
{{--                                                <a href="#" class="btn btn-primary">Detail</a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        @endforeach--}}


{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="card card-hero">--}}
{{--                            <div class="card-header">--}}
{{--                                <div class="card-icon">--}}
{{--                                    <i class="far fa-question-circle"></i>--}}
{{--                                </div>--}}
{{--                                <h4></h4>--}}
{{--                                <div class="card-description">Njangi</div>--}}
{{--                            </div>--}}
{{--                            <div class="card-body p-0">--}}
{{--                                <div class="tickets-list">--}}
{{--                                    <a href="#" class="ticket-item">--}}
{{--                                        <div class="ticket-title">--}}
{{--                                            <h4>Total Group</h4>--}}
{{--                                        </div>--}}
{{--                                        <div class="ticket-info">--}}
{{--                                            <div><h5>{{$njangiGroupsCount}}</h5></div>--}}
{{--                                            <div class="bullet"></div>--}}
{{--                                            <div class="text-primary"></div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class="ticket-item">--}}
{{--                                        <div class="ticket-title">--}}
{{--                                            <h4>Total Loan Request</h4>--}}
{{--                                        </div>--}}
{{--                                        <div class="ticket-info">--}}
{{--                                            <div><h5>{{$total_loan_request_ammount}}</h5></div>--}}
{{--                                            <div class=""></div>--}}
{{--                                            <div><h5>$</h5></div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class="ticket-item">--}}
{{--                                        <div class="ticket-title">--}}
{{--                                            <h4>Total Pending Loan</h4>--}}
{{--                                        </div>--}}
{{--                                        <div class="ticket-info">--}}
{{--                                            <div>Syahdan Ubaidillah</div>--}}
{{--                                            <div class="bullet"></div>--}}
{{--                                            <div>6 hours ago</div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                    <a href="features-tickets.html" class="ticket-item ticket-more">--}}
{{--                                        View All <i class="fas fa-chevron-right"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <a style="text-decoration: none" href="{{route('njangi_groups')}}">
                        <div class="card">
                            <div class="card-header bg-light"><h4 class="text-dark font-weight-bold">Njangi Group</h4></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Group Name</th>
                                            <th>Creator Name</th>
                                            <th>Total Member</th>
                                            <th>Created at</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @php($i=1)
                                        @foreach($njangiGroups as $njangiGroup)
                                                <tr>
                                                    <td>{{$i++}}</td>
{{--                                                    <td class="align-middle">--}}
{{--                                                        <img--}}
{{--                                                            alt="image"--}}
{{--                                                            src=""--}}
{{--                                                            class="rounded-circle"--}}
{{--                                                            width="50"--}}
{{--                                                            data-toggle="tooltip"--}}
{{--                                                            title=""--}}
{{--                                                            data-original-title="Wildan Ahdian"--}}
{{--                                                        />--}}
{{--                                                    </td>--}}
                                                    <td>{{$njangiGroup->group_name}}</td>

                                                    <td>{{$njangiGroup->njangiCreator->name}}</td>
                                                @php($total = count(\App\Models\NjangiGroupMember::where('group_id','=',$njangiGroup->id)->get()))
                                                    <td>{{$total}}</td>
                                                    <td>{{$njangiGroup->created_at}}</td>
                                                </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <a style="text-decoration: none" href="">
                        <div class="card">
                            <div class="card-header bg-light"><h4 class="text-dark font-weight-bold">Investment Groups</h4></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Group Name</th>
                                            <th>Creator Name</th>
                                            <th>Total Member</th>
                                            <th>Created at</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @php($i=1)
                                        @foreach($investmentGroups as $investmentGroup)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                {{--                                                    <td class="align-middle">--}}
                                                {{--                                                        <img--}}
                                                {{--                                                            alt="image"--}}
                                                {{--                                                            src=""--}}
                                                {{--                                                            class="rounded-circle"--}}
                                                {{--                                                            width="50"--}}
                                                {{--                                                            data-toggle="tooltip"--}}
                                                {{--                                                            title=""--}}
                                                {{--                                                            data-original-title="Wildan Ahdian"--}}
                                                {{--                                                        />--}}
                                                {{--                                                    </td>--}}
                                                <td>{{$investmentGroup->group_name}}</td>

                                                <td>{{$investmentGroup->investCreator->name}}</td>
                                                @php($total = count(\App\Models\InvestmentGroupMember::where('group_id','=',$njangiGroup->id)->get()))
                                                <td>{{$total}}</td>
                                                <td>{{$investmentGroup->created_at}}</td>
                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


            {{--<div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="sales-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sales</h4>
                        </div>
                        <div class="card-body">
                            4,732
                        </div>
                    </div>
                </div>
            </div>--}}
    </div>
        </section>
    </div>

@endsection

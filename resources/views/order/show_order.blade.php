
@extends('layouts.app')

@section('content')


<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card" dir="rtl" >
                <div class="card-header text-center" >طلباتك السابقة

                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">الاسم</th>
                                <th scope="col">الهاتف</th>
                                <th scope="col">الايميل</th>
                                <th scope="col">التاريخ</th>
                                <th scope="col">الوقت</th>
                                <th scope="col">اسم الوجبة</th>
                                <th scope="col">العدد</th>
                                <th scope="col">سعر الوجبة</th>
                                <th scope="col">المجموع($)</th>
                                <th scope="col">العنوان</th>
                                <th scope="col">حالة الطلب</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $row)
                                <tr>
                                    <td>{{ $row->user->name }}</td>
                                    <td>  {{$row->phone}}</td>
                                    <td >{{ $row->user->email }} </td>

                                    <td>{{ $row->date }}</td>
                                    <td>{{ $row->time }}</td>
                                    <td>{{ $row->meal->name }}</td>
                                    <td>{{ $row->qty }}</td>
                                    <td>{{ $row->meal->price}}</td>
                                    <td>${{ ($row->meal->price * $row->qty)}}</td>

                                    <td>{{ $row->address }}</td>

                                    @if($row->status=="تتم مراجعة الطلب")

                                    <td class="text-light bg-secondary" >{{ $row->status }}</td>

                                    @endif

                                    @if($row->status=="رفض")

                                    <td class="text-light bg-danger" >{{ $row->status }}</td>

                                    @endif

                                    @if($row->status=="قبول")

                                    <td class="text-light bg-primary" >{{ $row->status }}</td>

                                    @endif

                                    @if($row->status=="إتمام")

                                    <td class="text-light bg-success" >{{ $row->status }}</td>

                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .card-header {
        background-color:rgb(94, 175, 83);
        color: #fff;
        font-size: 20px;
    }

</style>





@endsection

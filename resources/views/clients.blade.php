@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('clients.create')}}" class="btn btn-primary">Создать клиента</a>
    <table class="table  table-hover mt-5">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ФИО</th>
            <th scope="col">Машина</th>
            <th scope="col">Гос. номер</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($clientsCar as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->fio}}</td>
            <td>{{$item->brand . " " . $item->model}}</td>
            <td>{{$item->number}}</td>
            <td><form action="{{route('clients.edit', $item->id)}}" method="get"><button type="submit" class="btn btn-link"><img src="{{asset('/img/edit.png')}}" alt="" srcset=""></button></form></td>
            <td><form action="{{route('clients.destroy', $item->car_id)}}" method="post">@csrf @method('DELETE')<button type="submit" class="btn btn-link"><img src="{{asset('/img/bin.png')}}" alt="" srcset=""></button></form></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$clientsCar->onEachSide(0)->links()}}
</div>
@endsection
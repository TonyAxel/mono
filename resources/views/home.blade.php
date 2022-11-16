@extends('layouts.app')

@section('content')
<div class="container">
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
          @foreach ($carParking as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->fio}}</td>
            <td>{{$item->brand . " " . $item->model}}</td>
            <td>{{$item->number}}</td>
            <td><form action="{{route('clients.edit', $item->id)}}" method="get"><button type="submit" class="btn btn-link"><img src="{{asset('/img/edit.png')}}" alt="" srcset=""></button></form></td>
            <td><form action="{{route('clients.destroy', $item->id)}}" method="post">@csrf @method('DELETE')<button type="submit" class="btn btn-link"><img src="{{asset('/img/bin.png')}}" alt="" srcset=""></button></form></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$carParking->onEachSide(0)->links()}}

        <select class="form-select" id="client" aria-label="Default select example" name="as">
            <option selected value="0">Выберите клиента</option>
            @foreach ($clientsSelect as $item)
                <option value="{{$item->id}}" id="opClient">{{$item->fio}}</option>
            @endforeach
        </select>

        <select class="form-select mt-2" id="selectCar" aria-label="Default select example">
            <option selected value="0">Выберите машину</option>
        </select>
</div>
@endsection

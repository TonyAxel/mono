@extends('layouts.app')

@section('content')
    <div class="container card">
        @foreach ($client as $item)
        <form class="card-body" method="POST" action="{{route('clients.update', $item->id)}}" id="formsAdd">
            @csrf
            @method('PATCH')
            <div class="mb-3">
              <label class="form-label">Фамилия Имя Отчество</label>
              <input class="form-control" name="fio" onkeyup="this.value = this.value.replace(/[^А-Яа-я\s]/g,'');" value="{{$item->fio}}">
            </div>
            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" @if ($item->gender == 'Женский') @checked(true) @endif value="Женский">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Женский
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"  @if ($item->gender == 'Мужской') @checked(true) @endif value="Мужской">
                    <label class="form-check-label" for="flexRadioDefault2">
                      Мужской
                    </label>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="typePhone" class="form-label">Телефон</label>
                <input type="tel" class="form-control" id="phone" name="phone" maxlength="14" value="{{$item->phone}}" onkeyup="this.value = this.value.replace(/[^\d\+\(\)-]/g,'');">
            </div>
            <div class="mb-3">
                <label class="form-label">Адрес</label>
                <input class="form-control" id="inputAddressMD" name="addres" value="{{$item->addres}}">
            </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Обновить</button>
          </form>
    </div>
    
    @foreach ($cars as $item)
    <div class="container card mt-5">
      <form class="card-body" method="post" action="{{route('updateCar', $item->id)}}" id="formsAdd">
          @csrf
          @method('PATCH')
          <div class="mb-3">
            <label class="form-label">Марка автомобиля</label>
            <input class="form-control" name="brand" value="{{$item->brand}}">
          </div>
          <div class="mb-3">
              <label for="typePhone" class="form-label">Модель автомобиля</label>
              <input class="form-control" name="model" value="{{$item->model}}">
          </div>
          <div class="mb-3">
              <label class="form-label">Цвет</label>
              <input class="form-control" name="color" value="{{$item->color}}">
          </div>
          <div class="mb-3">
              <label class="form-label">Гос. номер</label>
              <input class="form-control number" name="number" value="{{$item->number}}">
          </div>
          <div class="d-flex">
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" @if ($item->check == 1) @checked(true) @endif value="1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    На стоянке
                  </label>
              </div>
              <div class="form-check ms-3">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"  @if ($item->check == 0) @checked(true) @endif value="0">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Не на стоянке
                  </label>
              </div>
          </div>
          <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
    @endforeach

    <div class="container card mt-5">
      @foreach ($client as $item)
      <form class="card-body" method="post" action=" {{route('addCar', $item->id)}}">
      @endforeach
          @csrf
          <div class="mb-3">
            <label class="form-label">Марка автомобиля</label>
            <input class="form-control" name="brand">
          </div>
          <div class="mb-3">
              <label for="typePhone" class="form-label">Модель автомобиля</label>
              <input class="form-control" name="model">
          </div>
          <div class="mb-3">
              <label class="form-label">Цвет</label>
              <input class="form-control" name="color">
          </div>
          <div class="mb-3">
              <label class="form-label">Гос. номер</label>
              <input class="form-control number" name="number">
          </div>
          <div class="d-flex">
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault1"value="1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    На стоянке
                  </label>
              </div>
              <div class="form-check ms-3">
                  <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault2"value="0">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Не на стоянке
                  </label>
              </div>
          </div>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
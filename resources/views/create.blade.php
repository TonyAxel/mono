@extends('layouts.app')

@section('content')
    <div class="container card">
        <form class="card-body" method="POST" action="{{route('clientCreate')}}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Фамилия Имя Отчество</label>
              <input class="form-control" name="fio" onkeyup="this.value = this.value.replace(/[^А-Яа-я\s]/g,'');">
            </div>
            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked value="Женский">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Женский
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"  value="Мужской">
                    <label class="form-check-label" for="flexRadioDefault2">
                      Мужской
                    </label>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="typePhone" class="form-label">Телефон</label>
                <input type="tel" class="form-control" name="phone" id="typePhone" maxlength="15" onkeyup="this.value = this.value.replace(/[^\d\+\(\)-]/g,'');">
            </div>
            <div class="mb-3">
                <label class="form-label">Адрес</label>
                <input class="form-control" id="inputAddressMD" name="addres">
            </div>
    </div>

    <div class="container card mt-5">
      <div class="card-body">
          <div class="mb-3">
            <label class="form-label">Марка автомобиля</label>
            <input class="form-control" name="brand">
          </div>
          <div class="mb-3">
              <label for="typePhone" class="form-label">Модель автомобиля</label>
              <input type="adress" class="form-control" name="model">
          </div>
          <div class="mb-3">
              <label class="form-label">Цвет</label>
              <input class="form-control" name="color">
          </div>
          <div class="mb-3">
              <label class="form-label">Гос. номер</label>
              <input class="form-control" name="number">
          </div>
          <div class="d-flex">
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault1" checked value="1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    На стоянке
                  </label>
              </div>
              <div class="form-check ms-3">
                  <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault2"  value="0">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Не на стоянке
                  </label>
              </div>
          </div>
          <div>
            <button type="submit" class="btn btn-primary">Создать</button>
          </div>
        </form>
      </div> 
    </div>
@endsection
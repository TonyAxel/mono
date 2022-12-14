@extends('layouts.app')

@section('content')
  <form class="card-body" method="POST" action="{{route('clientCreate')}}" id="formsAdd">
    <div class="container card">
            @csrf
            <div class="mb-3">
              <label class="form-label">Фамилия Имя Отчество</label>
              <input class="form-control @error('fio') is-invalid @enderror" name="fio" onkeyup="this.value = this.value.replace(/[^А-Яа-я\s]/g,'');" value="{{ old('fio') }}">
            </div>
            @error('fio')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" >
            </div>
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label class="form-label">Адрес</label>
                <input class="form-control" id="inputAddressMD" name="addres">
            </div>
    </div>

    <div class="container mt-3">
      <div>
        <button type="button" id="countCar" class="btn btn-primary">Добавить машину</button>
      </div>
    </div>
    

    <div class="container card mt-5">
      <div class="card-body">
          <div class="mb-3">
            <label class="form-label">Марка автомобиля</label>
            <input class="form-control  @error('brand') is-invalid @enderror"" name="brand[]">
          </div>
          @error('brand.0')
            <div class="alert alert-danger">The brand field is required.</div>
          @enderror
          <div class="mb-3">
              <label for="typePhone" class="form-label">Модель автомобиля</label>
              <input type="adress" class="form-control" name="model[]">
          </div>
          @error('model.0')
            <div class="alert alert-danger">The model field is required.</div>
          @enderror
          <div class="mb-3">
              <label class="form-label">Цвет</label>
              <input class="form-control" name="color[]">
          </div>
          @error('color.0')
            <div class="alert alert-danger">The color field is required.</div>
          @enderror
          <div class="mb-3">
              <label class="form-label">Гос. номер</label>
              <input class="form-control number" name="number[]" id="number">
          </div>
          @error('number.0')
            <div class="alert alert-danger">The number field is required.</div>
          @enderror
          <div class="d-flex radioValue">
              <div class="form-check">
                  <input class="form-check-input " type="radio" name="flexRadioDefault1" id="flexRadioDefault1" checked value="1">
                  <label class="form-check-label " for="flexRadioDefault1">
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
            <button type="submit" class="btn btn-primary" id="btnCreate">Создать</button>
          </div>
        </div> 
      </div>
    </form>
      
@endsection
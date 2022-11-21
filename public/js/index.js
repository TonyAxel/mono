'use strict';

    
    $('#countCar').click(function()
    {
        $('#btnCreate').remove();
        $('.radioValue').remove();
                let element = 
                `
                <div class="container card mt-5">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Марка автомобиля</label>
                            <input class="form-control" name="brand[]">
                        </div>
                        <div class="mb-3">
                            <label for="typePhone" class="form-label">Модель автомобиля</label>
                            <input type="adress" class="form-control" name="model[]">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Цвет</label>
                            <input class="form-control" name="color[]">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Гос. номер</label>
                            <input class="form-control" name="number[]" id="number">
                        </div>
                        <div class="d-flex radioValue">
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
                            <button type="submit" class="btn btn-primary" id="btnCreate">Создать</button>
                        </div>
                        </form>
                    </div> 
                </div>
                `;
                $('#formsAdd').append(element);
    });

if(document.getElementById('client') != null){
    var selOption = document.getElementById('client');

    function onChangeClient() {
    let value = selOption.value;
    if (value != 0) {
        $.ajax({
            'url': '/clients/car',
            'type': 'post',
            'data': { title: value },
            'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
                $('#selectCar > .options').remove();
                $('.container > #checkInput').remove();
                data.forEach(element => {
                    let option =  $("<option class='options'></option>").text('Марка машины: ' + element.brand + ' Модель машины: ' +
                    element.model + ' Гос.номер машины: ' + element.number).val(element.id);
                    $('#selectCar').append(option);
                });
            }
        });
    }
    else {
        $('#selectCar > .options').remove();
    }
}

selOption.onchange = onChangeClient;

onChangeClient();
}



if( document.getElementById('selectCar') != null){
    var selOptionCar = document.getElementById('selectCar');

    function onChangeCar() {
        let value = selOption.value;
        if (value != 0) {
            $('.container > #checkInput').remove();
    
            let element = `
            <div class='d-flex mt-3' id='checkInput'>
                <div class="form-check">
                    <input class='form-check-input radio' type='radio' name='flexRadioDefault' id='flexRadioDefault1' value='1'>
                    <label class="form-check-label"  id='checkPark1'>
                        На стоянке
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input radio" type="radio" name="flexRadioDefault" id="flexRadioDefault2"  value="0">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Не на стоянке
                    </label>
                </div>
            </div>
                `;
            $('.container').append(element);
        }
            if(document.querySelectorAll('.radio') != null){
            const radio = document.querySelectorAll('.radio');
            radio.forEach(item => {
                item.addEventListener('click', () => {
                    $('.container > .message').remove();
                        let val = item.value;
                        let idCar = document.getElementById('selectCar').value;
                        if(idCar != 0){
                        
                            if(val == 0){
                                
                                $.ajax({
                                    'url': '/clients/car/check',
                                    'type': 'post',
                                    'data': { value: val, id: idCar },
                                    'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                                    success: function (data) {
                                        let option =  $("<p class='message text-uppercase'></p>").text(data);
                                        $('.container').append(option);
                                    }
                                });
                            }
                            if(val == 1){
                                $('.container > .message').remove();
                                $.ajax({
                                    'url': '/clients/car/check',
                                    'type': 'post',
                                    'data': { value: val, id: idCar },
                                    'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                                    success: function (data) {
                                        let option =  $("<p class='message text-uppercase'></p>").text(data);
                                        $('.container').append(option);
                                    }
                                });
                            }
                        }
                });
            });
            
        }
    }
    selOptionCar.onchange = onChangeCar;
    
    onChangeCar();
}





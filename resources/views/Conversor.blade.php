@include('scripts.global')
@stack('scripts-axios')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    @stack('stylesheet')
    @stack('stylesheet-theme')

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <label for="dataCota">Data da cotação</label>
                <input type="text" class="form-control w-25" aria-label="dataCota">
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" placeholder="First name" aria-label="First name">
            </div>
            <div class="col-3">
                <label class="visually-hidden" for="specificSizeSelect">Preference</label>
                <select class="form-select" id="specificSizeSelect">
                    <option value="1">BRL</option>
                </select>
            </div>
            <div class="col-3">
                <i class="fas fa-exchange"></i>
            </div>
            <div class="col-3">
                <label class="visually-hidden" for="specificSizeSelect">Preference</label>
                <select class="form-select" id="specificSizeSelect">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
    </div>

    <script type="module">
        import {
            request
        } from "{{asset('js/axios.js')}}";
        import {
            config
        } from "{{asset('js/axios.js')}}";
        const instance = config("{{ url('api/v1')}}");
        //request(axios,"{{ url('test/request')}}").then(data => { console.log(data); }).catch(err => console.log(err));
        /*
        // Send a POST request OK
        instance({
            method: 'post',
            url: "/login",
            data: {
              email: 'naelson.g.saraiva@gmail.com',
              password: 'admin123'
            }
          }).then(function(response){
            console.log(response.data);
          }).catch(err => console.log(err));
        */
        /*
        // Send a POST request OK
          axios({
            method: 'post',
            url: "{{ url('/test/request/validation')}}",
            data: {
              email: 'naelson.g.saraiva@gmail.com',
              password: 'admin123'
            }
          }).then(function(response){
            console.log(response.data);
          }).catch(err => console.log(err));
          */
    </script>
</body>

</html>
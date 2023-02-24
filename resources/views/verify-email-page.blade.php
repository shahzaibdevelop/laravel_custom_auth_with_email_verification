<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Document</title>
    <style>
        .container{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 50px;
            margin-top: 100px;
         
        }
:placeholder-shown{
    font-size: 1.7vh;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Verification</h1>
    <form action="/verify-email" method="POST">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Verification Code</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="verifyCode" placeholder="Enter 6 Digit Code" style="padding: 15px 120px 15px 15px;">
          @error('verifyCode')
          <br>
              <span class="alert alert-danger">{{$message}}</span>
            <br>
          @enderror
        </div>
        <button type="submit" class="btn btn-dark">Verify Email</button>
      </form>
        </div>


    {{-- JavaScript Code --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>
</html>
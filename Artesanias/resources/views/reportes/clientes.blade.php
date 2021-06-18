<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
    <h1>Reporte de clientes del {{$fecha}}</h1>

    <table >
                <thead>
                    <tr>    
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th>Ciudad</th>  
                        <th></th>                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos as $c)
                    <tr>
                        
                        <td>{{$c->name}}</td>
                        <td>{{$c->email}}</td>
                        <td>{{$c->address}}</td>
                        <td>{{$c->city}}</td>                       
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
</body>
</html>
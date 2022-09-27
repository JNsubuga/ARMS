<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            table{
                width: 100%;
                /* margin-top: 8rem; */
            }

            table, th, td{
                border-bottom: solid rgba(0, 0, 0, 0.3) 1px;
                text-align: left;
                border-collapse: collapse;
            }
            
            td{
                font-size: 0.65rem
            }

            th{
                font-size: 0.75rem
            }

            header{
                position: relative;
                width: 100%;
                padding: 0;
                height: auto;
            }
            
            header .right{
                position: absolute;
                padding: 0;
                margin: 0;
                right: 0px;
                font-size: 0.75rem;
                width: auto;
                height: auto;
            }

            header .logo{
                position: absolute;
                padding: 0;
                margin: 0;
                left: 0px;
                width: auto;
                height: auto;

            }

            header .right h3{
                padding: 0; 
                margin: 0;
            }

            header .right ul{
                padding: 0; 
                margin: 0;
                list-style: none;
            }
            
            .heading{
                text-align: center;
                /* text-transform: uppercase; */
                text-transform:capitalize;
                text-decoration: underline;
                font-style: italic;
                margin-top: 6rem;
                font-size: 0.8rem;
                font-weight:bold;
            }

            .text-right{
                text-align: right;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="logo">
                <img src="./img/cow_cattle_farm_262786.jpg" width="100" height="95" style="border-radius: 4rem 4rem 4rem 4rem">
            </div>
            <div class="right">
            <h3><i>CompanyNamewie;qoiv;fvjlkjglgk</i></h3>
            <ul>
                <li><b>Location:<i></i></b></li>
                <li><b>Office Contact:<i></i></b></li>
                <li><b>Mobile:<i></i></b></li>
                <li><b>E-mail:<i></i></b></li>
                <li><b>Date:<i><?php echo ' '.date('d/m/Y', strtotime(now())) ?></i></b></li>
            </ul>
            </div>
        </header>
        <div class="heading">
            This is the heading of this document
        </div>
        <table class="table">
            <tr class="trh">
                <th>Date</th>
                <th>Product</th>
                <th class="text-right">Quantity Recieved</th>
                <th class="text-right">Quantity Sold</th>
                <th class="text-right">Quantity in Stock</th>
            </tr>
            @forelse ($bincards as $bincard)
                <tr>
                    <td>
                        {{ date('d/m/Y', strtotime($bincard->created_at)) }}
                    </td>
                    <td>
                        {{ $bincard->product->Name }}
                    </td>
                    <td class="text-right">
                        {{ number_format($bincard->receivedQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                    </td>
                    <td  class="text-right">
                        {{ number_format($bincard->soldQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                    </td>
                    <td class="text-right">
                        {{ number_format($bincard->stockQuantity, 2, '.',',') }} {{ $bincard->unit->Abbriviation }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"><p>No record in the Database</p></td> 
                </tr>
            @endforelse
        </table>
    </body>
</html>
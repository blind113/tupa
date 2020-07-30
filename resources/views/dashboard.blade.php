@extends('html')
@section('title', 'Inventarios')
@section('content')

<?php    //echo '<pre>'.print_r($mouse,true).'</pre>'; ?>

<div class = 'row form-group'>
    <div class = 'col-md-5'>
        <div class = 'panel info-box panel-white'>
            <div class = 'panel-body'>
                <div class = 'info-box-icon'><i class = 'fa fa-gamepad'></i></div>
                <table class = 'table'>
                    <thead>
                        <tr>
                            <th>Qtd</th>
                            <th>Dono</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($mouse as $m)
                            {
                                echo '<tr>';
                                    echo'<td>'.$m['qtd'].'</td>';
                                    echo'<td>'.$m['dono'].'</td>';
                                    echo'<td>'.$m['descricao'].'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class = 'col-md-5'>
        <div class = 'panel info-box panel-white'>
            <div class = 'panel-body'>
               <div class = 'info-box-icon'><i class = 'fa fa-desktop'></i></div>
               <table class = 'table'>
                    <thead>
                        <tr>
                            <th>Qtd</th>
                            <th>Dono</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($monitor as $m)
                            {
                                echo '<tr>';
                                    echo'<td>'.$m['qtd'].'</td>';
                                    echo'<td>'.$m['dono'].'</td>';
                                    echo'<td>'.$m['descricao'].'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class = 'row form-group'>
    <div class = 'col-md-5'>
        <div class = 'panel info-box panel-white'>
            <div class = 'panel-body'>
                <div class = 'info-box-icon'><i class = 'fa fa-keyboard-o'></i></div>
                <table class = 'table'>
                    <thead>
                        <tr>
                            <th>Qtd</th>
                            <th>Dono</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($teclado as $m)
                            {
                                echo '<tr>';
                                    echo'<td>'.$m['qtd'].'</td>';
                                    echo'<td>'.$m['dono'].'</td>';
                                    echo'<td>'.$m['descricao'].'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class = 'col-md-5'>
        <div class = 'panel info-box panel-white'>
            <div class = 'panel-body'>
                <div class = 'info-box-icon'><i class = 'fa fa-headphones'></i></div>
                <table class = 'table'>
                    <thead>
                        <tr>
                            <th>Qtd</th>
                            <th>Dono</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($cabo  as $m)
                            {
                                echo '<tr>';
                                    echo'<td>'.$m['qtd'].'</td>';
                                    echo'<td>'.$m['dono'].'</td>';
                                    echo'<td>'.$m['descricao'].'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





@stop
@extends('auth.layout')
@section('content')
    <div class="login">
        <div class="login__header">
            <svg style="width:48px;height:48px" viewBox="0 0 24 24">
                <path fill="#000000"
                      d="M11,2H13V4H15V6H13V9.4L22,13V15L20,14.2V22H14V17A2,2 0 0,0 12,15A2,2 0 0,0 10,17V22H4V14.2L2,15V13L11,9.4V6H9V4H11V2M6,20H8V15L7,14L6,15V20M16,20H18V15L17,14L16,15V20Z"/>
            </svg>
            <div>
                <span>Controle Diocesano de Atendimento</span>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                <path fill="#000000"
                                      d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                            </svg>
                        </span>
                    </div>
                    <input required type="email" class="form-control" placeholder="E-mail" name="email" id="email">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                <path fill="#000000"
                                      d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z"/>
                            </svg>
                        </span>
                    </div>
                    <input required type="password" class="form-control" placeholder="Senha" name="password" id="password">
                </div>
                <div class="action-submit">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
        </form>

    </div>
@endsection
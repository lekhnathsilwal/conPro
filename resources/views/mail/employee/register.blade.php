<BODY>

<p align=center><img border=0 hspace=0 alt="" align=baseline src="{{$message->embed(asset("assets/img/els_banner.jpg"))}}" style="height: 100px;width: 600px"></p>

<DIV align=center>

    <TABLE style="MARGIN-LEFT: auto; WIDTH: 600px; MARGIN-RIGHT: auto" cellSpacing=0 cellPadding=0 align=center>

        <TBODY>

        <TR>

            <TD style=" PADDING-BOTTOM: 10px;BACKGROUND-COLOR: #fcfcfc" vAlign=top>Dear {{$data['name']}},
                <h3>{{config('app.name')}}</h3>
                <h4>Employee Account Detail</h4>

                <p>Here are your account description.</p>
                <div class="alert alert-success">A request to create your Account by <strong>{{$data['created_by_name']}}</strong> has been made.
                    If you do not made this request simply ignore this email.If you did make this request,please complete your registration.
                    <br><br>
                    You can login using given email and password after account being verified.
                    <br><br>
                    Email:&nbsp;&nbsp;{{$data['email']}}<br>
                    Password:&nbsp;&nbsp;{{$data['password']}}&nbsp;&nbsp;(Note:Please change password in first login)
                </div><br><br>
                <span><a class="btn btn-primary btn-lg p-3 mr-2" href="{{URL::SignedRoute('employee.verify',["id"=>$data['id']])}}">Active your Account</a></span>
            </TD>

        </TR>


        <TR>

            <TD style="min-height:30px;TEXT-ALIGN: center; padding: 10px; BACKGROUND-COLOR: #2a2a2a">

                <p style="color: #ffffff">{{config('app.name')}}</p>

                <SPAN style="COLOR: #c3c3c3">Kalanki-14,Kashibazar<BR>Kathmandu,Nepal 44600<BR></SPAN>

            </TD>

        </TR>

        <!--FOOTER END-->

        </TBODY>

    </TABLE>

</DIV>

</BODY>


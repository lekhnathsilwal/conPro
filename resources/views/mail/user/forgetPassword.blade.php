<BODY>

<p align=center><img border=0 hspace=0 alt="" align=baseline src="{{asset("assets/img/els_banner.jpg")}}" style="height: 100px;width: 600px"></p>

<DIV align=center>

    <TABLE style="MARGIN-LEFT: auto; WIDTH: 600px; MARGIN-RIGHT: auto" cellSpacing=0 cellPadding=0 align=center>

        <TBODY>

        <TR>

            <TD style=" PADDING-BOTTOM: 10px;BACKGROUND-COLOR: #fcfcfc" vAlign=top>Dear {{$data['name']}},
                <h3>{{config('app.name')}}</h3>
                <h4>Forget Email Password Reset</h4>

                <p>Here are your password reset instruction.</p>
                <div class="alert alert-success">A request to change your account <strong>{{$data['email']}}</strong> password has been made.
                    If you do not made this request simply ignore this email.If you did make this request,please reset your password.</div>
                <br><br>
                <span><a class="btn btn-primary btn-lg p-3 mr-2" href="{{URL::SignedRoute('user.reset.password',["id"=>$data['id']])}}">Set New Password</a></span>
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



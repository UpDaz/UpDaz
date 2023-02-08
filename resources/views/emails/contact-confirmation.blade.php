@extends('layouts.email')

@section('title')
Accusé de réception - demande de contact
@endsection

@section('content')
@include('elements.emails.image', ['path' => 'https://www.updaz.fr/img/emails/letter-box.png', 'alt' => 'Boite aux lettres'])
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
    <tbody>
      <tr>
        <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0;padding-top:0;text-align:center;">
          <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" width="600px" ><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
          <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;">
              <tbody>
                <tr>
                  <td style="direction:ltr;font-size:0px;padding:20px 0;padding-left:15px;padding-right:15px;text-align:center;">
                    <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:570px;" ><![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                        <tbody>
                          <tr>
                            <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                              <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381;">
                                    Merci pour votre demande, je reviens vers vous dans les plus brefs délais.
                                    <br/>
                                    Pour rappel voici les informations que vous m'avez envoyé :<br><br/>
                                    Identité : <b>{{ ucfirst($firstname) }} {{ strtoupper($lastname) }}</b>
                                    <br/><br/>
                                    Email : <b>{{ $email }}</b>
                                    <br/><br/>
                                    Téléphone : <b>{{ $phone }}</b>
                                    <br/><br/>
                                    Message : <br/><i>{{ $client_message }}</i>
                                    <br/><br/>
                                    ☞ Si votre demande concerne un projet à venir, merci de bien vouloir renseigner ceci : @include('elements.emails.button', ['content' => "accéder au formulaire d'information", 'link' => 'https://14r0dvle4i4.typeform.com/to/kEyCbkxN'])
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!--[if mso | IE]></td></tr></table><![endif]-->
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--[if mso | IE]></td></tr></table></td></tr></table><![endif]-->
        </td>
      </tr>
    </tbody>
</table>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use GuzzleHttp;
use GuzzleHttp\Client;

use \App\Utils\Convert as Convert;

class ExternalConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = '<context>

	<!-- event -->
	<event>
		<!-- fixed fields -->
		<workspaceId>{ID DO AMBIENTE NA QUAL O EVENTO OCORREU}</workspaceId>
		<workspace>{NOME DO AMBIENTE NA QUAL O EVENTO OCORREU}</workspace>
		<name>{NOME DO EVENTO OCORRIDO}</name>
		<eventPlataformId>{IDENTIFICAÇAO DO EVENTO PLATAFORMA ASSOCIADO AO EVENTO EXECUTADO}</eventPlataformId>
		<actionParameter>{PARAMETRO INSERIDO PELO USUARIO NO CADASTRO DA ACAO DE UM EVENTO}</actionParameter>
		<connectorParameter>{PARAMETRO INSERIDO PELO USUARIO AO CADASTRAR UM CONECTOR}</connectorParameter>
		
		<!-- aleatoryFields -->
		<eventParameters>
			<eventParameter>
				<key></key>
				<value></value>
			</eventParameter>
			<eventParameter>
				<key></key>
				<value></value>
			</eventParameter>
		</eventParameters>
	</event>

	<!-- Who -->
	<agent>
		<id></id>
		<name></name>
		<active ></active >
		<alternativeIdentifier></alternativeIdentifier>
		<observation></observation>
		<agentType>
			<id></id>
			<alternativeIdentifier></alternativeIdentifier>
			<description></description>
		</agentType>
		<city></city>
		<neighborhood></neighborhood>
		<country></country>
		<state></state>
		<street></street>
		<streetType></streetType>
		<zipCode></zipCode>
		<email></email>
		<streetNumber></streetNumber>
		<streetComplement></streetComplement>
		<cellphoneIdd></cellphoneIdd>
		<cellphoneStd></cellphoneStd>
		<cellphone></cellphone>
		<phoneIdd></phoneIdd>
		<phoneStd></phoneStd>
		<phone></phone>
		<recordNumber1></recordNumber1>
		<recordNumber2></recordNumber2>
		<recordNumber3></recordNumber3>
		<recordNumber4></recordNumber4>
		<recordNumber5></recordNumber5>
		<recordComplement1></recordComplement1>
		<recordComplement2></recordComplement2>
		<recordComplement3></recordComplement3>
		<recordComplement4></recordComplement4>
		<recordComplement5></recordComplement5>
		<recordComplement6></recordComplement6>
		<recordComplement7></recordComplement7>
		<recordComplement8></recordComplement8>
		<recordComplement9></recordComplement9>
		<recordComplement10></recordComplement10>
		<recordDate1>{FORMATO yyyy-mm-dd}</recordDate1>
		<recordDate2>{FORMATO yyyy-mm-dd}</recordDate2>
		<recordDate3>{FORMATO yyyy-mm-dd}</recordDate3>
		<recordDate4>{FORMATO yyyy-mm-dd}</recordDate4>
		<recordDate5>{FORMATO yyyy-mm-dd}</recordDate5>
		<recordValue1></recordValue1>
		<recordValue2></recordValue2>
		<recordValue3></recordValue3>
		<recordValue4></recordValue4>
		<recordValue5></recordValue5>
		<login></login>
		<centerwebUser></centerwebUser>
		<mobileUser></mobileUser>
		<biUser></biUser>
		<biUserRole></biUserRole>
		<inputWebAsAnotherUser></inputWebAsAnotherUser>
		<centerwebUserRole></centerwebUserRole>
		<validateClient></validateClient>
		<exportStatus></exportStatus>
		<customFields>
			<customField>
				<id>1</id>
				<fieldType></fieldType>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
				<size></size>
				<active></active>
				<viewQueryOnMobile></viewQueryOnMobile>
				<customFieldValues>
					<customFieldValue>
						<internalValue>1</internalValue>
						<externalValue>1</externalValue>
					</customFieldValue>
				</customFieldValues>
			</customField>
		  	<customField>
				<id>2</id>
				<fieldType></fieldType>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
				<size></size>
				<active></active>
				<viewQueryOnMobile></viewQueryOnMobile>
				<customFieldValues>
					<customFieldValue>
						<internalValue>1</internalValue>
						<externalValue>1</externalValue>
					</customFieldValue>
				</customFieldValues>
		    </customField>
		    <customField>
				<id>3</id>
				<fieldType></fieldType>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
				<size></size>
				<active></active>
				<viewQueryOnMobile></viewQueryOnMobile>
				<customFieldValues>
					<customFieldValue>
						<internalValue>a</internalValue>
						<externalValue>A</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>b</internalValue>
						<externalValue>B</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>c</internalValue>
						<externalValue>C</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>d</internalValue>
						<externalValue>D</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>e</internalValue>
						<externalValue>E</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>f</internalValue>
						<externalValue>F</externalValue>
					</customFieldValue>
				</customFieldValues>
		    </customField>
		</customFields>
	</agent>

	<!-- Where -->
	<serviceLocal>
		<id></id>
		<alternativeIdentifier></alternativeIdentifier>
		<description></description>
		<geoCoordinate></geoCoordinate>
		<corporateName></corporateName>
		<streetType></streetType>
		<street></street>
		<streetNumber></streetNumber>
		<streetComplement></streetComplement>
		<zipCode></zipCode>
		<cellphoneIdd></cellphoneIdd>
		<cellphoneStd></cellphoneStd>
		<cellphoneNumber></cellphoneNumber>
		<phoneIdd></phoneIdd>
		<phoneStd></phoneStd>
		<phoneNumber></phoneNumber>
		<email></email>
		<cityNeighborhood></cityNeighborhood>
		<city></city>
		<state></state>
		<country></country>
		<observation></observation>
		<serviceLocalType></serviceLocalType>
		<serviceLocalClassification></serviceLocalClassification>
		<local3Dimension></local3Dimension>
		<recordNumber1></recordNumber1>
		<recordNumber2></recordNumber2>
		<recordNumber3></recordNumber3>
		<recordNumber4></recordNumber4>
		<recordNumber5></recordNumber5>
		<recordComplement1></recordComplement1>
		<recordComplement2></recordComplement2>
		<recordComplement3></recordComplement3>
		<recordComplement4></recordComplement4>
		<recordComplement5></recordComplement5>
		<recordComplement6></recordComplement6>
		<recordComplement7></recordComplement7>
		<recordComplement8></recordComplement8>
		<recordComplement9></recordComplement9>
		<recordComplement10></recordComplement10>
		<recordDate1>{FORMATO yyyy-mm-dd}</recordDate1>
		<recordDate2>{FORMATO yyyy-mm-dd}</recordDate2>
		<recordDate3>{FORMATO yyyy-mm-dd}</recordDate3>
		<recordDate4>{FORMATO yyyy-mm-dd}</recordDate4>
		<recordDate5>{FORMATO yyyy-mm-dd}</recordDate5>
		<recordValue1></recordValue1>
		<recordValue2></recordValue2>
		<recordValue3></recordValue3>
		<recordValue4></recordValue4>
		<recordValue5></recordValue5>
		<active></active>
		<origin></origin>
		<insertDateTime>{FORMATO yyyy-mm-dd hh:mm:ss}</insertDateTime>
		<agentInsert>{ID DO AGENTE}</agentInsert>
		<lastUpdateDateTime>{FORMATO yyyy-mm-dd hh:mm:ss}</lastUpdateDateTime>
		<agentLastUpdate>{Id DO AGENTE}</agentLastUpdate>
		<accountable>{ID DO AGENTE RESPONSAVEL PELO LOCAL DE ATENDIMENTO}</accountable>
		<customFields>
			<customField>
				<id>1</id>
				<fieldType></fieldType>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
				<size></size>
				<active></active>
				<viewQueryOnMobile></viewQueryOnMobile>
				<customFieldValues>
					<customFieldValue>
						<internalValue>1</internalValue>
						<externalValue>1</externalValue>
					</customFieldValue>
				</customFieldValues>
			</customField>
		  	<customField>
				<id>2</id>
				<fieldType></fieldType>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
				<size></size>
				<active></active>
				<viewQueryOnMobile></viewQueryOnMobile>
				<customFieldValues>
					<customFieldValue>
						<internalValue>1</internalValue>
						<externalValue>1</externalValue>
					</customFieldValue>
				</customFieldValues>
		    </customField>
		    <customField>
				<id>3</id>
				<fieldType></fieldType>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
				<size></size>
				<active></active>
				<viewQueryOnMobile></viewQueryOnMobile>
				<customFieldValues>
					<customFieldValue>
						<internalValue>a</internalValue>
						<externalValue>A</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>b</internalValue>
						<externalValue>B</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>c</internalValue>
						<externalValue>C</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>d</internalValue>
						<externalValue>D</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>e</internalValue>
						<externalValue>E</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>f</internalValue>
						<externalValue>F</externalValue>
					</customFieldValue>
				</customFieldValues>
		    </customField>
		</customFields>
	</serviceLocal>

	<!-- When -->
	<schedule>
		<id></id>
		<situation></situation>
		<origin></origin>
		<hour>{FORMATO 24hs HH:mm}</hour>
		<date>{FORMATO yyyy-mm-dd}</date>
		<priority></priority>
		<executionDate>{FORMATO yyyy-mm-dd}</executionDate>
		<executionHour>{FORMATO 24hs HH:mm}</executionHour>
		<alternativeIdentifier></alternativeIdentifier>
		<exportSituation></exportSituation>
		<observation></observation>
		<active></active>
		<activitiesOrigin></activitiesOrigin>
		<customField1></customField1>
		<customField2></customField2>
		<customField3></customField3>
		<customField4></customField4>
		<customField5></customField5>
		<customField6></customField6>
		<customField7></customField7>
		<customField8></customField8>
		<customField9></customField9>
		<customField10></customField10>
		<executionForecastEndDate></executionForecastEndDate>
		<executionForecastEndTime></executionForecastEndTime>
		<toleranceBeforeStart></toleranceBeforeStart>
		<toleranceAfterStart></toleranceAfterStart>
		<toleranceBeforeEnd></toleranceBeforeEnd>
		<toleranceAfterEnd></toleranceAfterEnd>
		<toleranceBlockBefore></toleranceBlockBefore>
		<toleranceBlockAfter></toleranceBlockAfter>
		<executionStartDate>{FORMATO yyyy-mm-dd}</executionStartDate>
		<executionStartTime>{FORMATO 24hs HH:mm}</executionStartTime>
		<executionEndDate>{FORMATO yyyy-mm-dd}</executionEndDate>
		<executionEndTime>{FORMATO 24hs HH:mm}</executionEndTime>
		<recreateTaskOnPda></recreateTaskOnPda>
		<agent>
			<id></id>
			<alternativeIdentifier></alternativeIdentifier>
			<name></name>
		</agent>
		<serviceLocal>
			<id></id>
			<alternativeIdentifier></alternativeIdentifier>
			<description></description>
		</serviceLocal>
		<activities>
		  <activity>
			<id></id>
			<description></description>
			<alternativeIdentifier></alternativeIdentifier>
		  </activity>
		  <activity>
			<id></id>
			<description></description>
			<alternativeIdentifier></alternativeIdentifier>
		  </activity>	
		</activities>		
		<customFields>
		  	<customField>
				<id></id>
				<fieldType></fieldType>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
				<size></size>
				<active></active>
				<viewQueryOnMobile></viewQueryOnMobile>
				<customFieldValues>
					<customFieldValue>
						<internalValue>a</internalValue>
						<externalValue>A</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>b</internalValue>
						<externalValue>B</externalValue>
					</customFieldValue>
				</customFieldValues>
		    </customField>
		    <customField>
				<id></id>
				<fieldType></fieldType>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
				<size></size>
				<active></active>
				<viewQueryOnMobile></viewQueryOnMobile>
				<customFieldValues>
					<customFieldValue>
						<internalValue>a</internalValue>
						<externalValue>A</externalValue>
					</customFieldValue>
					<customFieldValue>
						<internalValue>b</internalValue>
						<externalValue>B</externalValue>
					</customFieldValue>
				</customFieldValues>
		    </customField>
		</customFields>
	</schedule>

	<!-- What -->
    <historicals>
    	<activityHistorical>
    		<id></id>
			<dataSource>{EXECUTADA PELO MOBILE = 0 - EXECUTADA PELO uMov.CENTER = 1}</dataSource>
    		<activity>
				<id></id>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
		  	</activity>
			<startTimeOnSystem>{FORMATO yyyy-mm-dd hh:mm:ss}</startTimeOnSystem>
			<finishTimeOnSystem>{FORMATO yyyy-mm-dd hh:mm:ss}</finishTimeOnSystem>
			<activityHistoryItems>
				<activityHistoryItem>
					<id></id>
					<section>
		  				<id></id>
						<alternativeIdentifier></alternativeIdentifier>
						<description></description>
		  			</section>
					<!-- item padrao nao sera exibido -->
		  			<item>
						<id></id>
						<description></description>
						<alternativeIdentifier></alternativeIdentifier>
					</item>
					<sectionField>
						<id></id>
						<alternativeIdentifier></alternativeIdentifier>
						<description></description>
						<type>N</type>
					</sectionField>
					<!-- 
					LISTA = Valores separados por @
					LISTA unica = String("carro")
					Alfanumerico = String("moto")
					LOGICO = conforme valores inseridos pelo usuário
					DATA = yyyy-mm-dd
					HORA = HH:mm
					NUMERICO = 12.45 ou 12
					 -->
					<value></value>
					<valueForExibition></valueForExibition>
				</activityHistoryItem>
				<activityHistoryItem>
					<id></id>
					<section>
		  				<id></id>
						<alternativeIdentifier></alternativeIdentifier>
						<description></description>
					</section>
					<!--  item padrao nao sera exibido -->
					<item>
						<id></id>
						<description></description>
						<alternativeIdentifier></alternativeIdentifier>
					</item>
					<sectionField>
						<id></id>
						<alternativeIdentifier></alternativeIdentifier>
						<description></description>
						<type>N</type>
					</sectionField>
					<!-- Lista Multipla(valores separados por @ ?) -->
		  			<value></value>
					<valueForExibition></valueForExibition>
				</activityHistoryItem>		
			</activityHistoryItems>
		</activityHistorical>
		<activityHistorical>
    		<id></id>
			<dataSource></dataSource>
    		<activity>
				<id></id>
				<alternativeIdentifier></alternativeIdentifier>
				<description></description>
		  	</activity>
			<startTimeOnSystem>{FORMATO yyyy-mm-dd hh:mm:ss}</startTimeOnSystem>
			<finishTimeOnSystem>{FORMATO yyyy-mm-dd hh:mm:ss}</finishTimeOnSystem>
			<activityHistoryItems>
				<activityHistoryItem>
					<id></id>
					<section>
		  				<id></id>
						<alternativeIdentifier></alternativeIdentifier>
						<description></description>
		  			</section>
					<!-- item padrao nao sera exibido -->
		  			<item>
						<id></id>
						<description></description>
						<alternativeIdentifier></alternativeIdentifier>
					</item>
					<sectionField>
						<id></id>
						<alternativeIdentifier></alternativeIdentifier>
						<description></description>
						<type>N</type>
					</sectionField>
					<value></value>
					<valueForExibition></valueForExibition>
				</activityHistoryItem>
				<activityHistoryItem>
					<id></id>
					<section>
		  				<id></id>
						<alternativeIdentifier></alternativeIdentifier>
						<description></description>
					</section>
					<!-- item padrao nao sera exibido  -->
					<item>
						<id></id>
						<description></description>
						<alternativeIdentifier></alternativeIdentifier>
					</item>
					<sectionField>
						<id></id>
						<alternativeIdentifier></alternativeIdentifier>
						<description></description>
						<type>N</type>
					</sectionField>
					<!--  Lista Multipla(valores separados por @ ?) -->
		  			<value></value>
					<valueForExibition></valueForExibition>
				</activityHistoryItem>		
			</activityHistoryItems>
		</activityHistorical>
	</historicals>
	
	<!-- mobile appearence -->
	<mobileAppearance>
		<iconColor>{cor dos ícones de menus e elementos de lista (1=verde umov, 2=branco, 3=preto, 4=cinza)}</iconColor>
		<buttonIconColor>{cor dos ícones de botões (1=branco, 2=preto, 3=cinza)}</buttonIconColor>
		<buttonAndHeaderColor>{cor dos botões e cabeçalhos}</buttonAndHeaderColor>
		<buttonFocussedColor>{cor dos botões em foco}</buttonFocussedColor>
		<buttonTextColor>{cor dos textos sobre os botões}</buttonTextColor>
		<otherTextColor>{cor dos demais textos}</otherTextColor>
		<backgroundColor>{cor de fundo da tela}</backgroundColor>
		<footerColor>{cor do rodapé}</footerColor>
		<linkMainImage>{link do imagem da tela inicial}</linkMainImage>
		<linkMenuImage>{link do imagem do menu principal}</linkMenuImage>
	</mobileAppearance>	
	
	<!-- center appearence -->
	<centerAppearance>
		<iconColor>{cor dos ícones dos menus (0-preto, 1-branco)}</iconColor>		
		<headerColor>{cor do cabeçalho}</headerColor>
		<menuBackgroundColor>{cor de fundo do menu}</menuBackgroundColor>
		<menuPrimaryColor>{cor primaria do menu}</menuPrimaryColor>
		<menuPrimaryTextColor>{cor do texto do menu primario do menu}</menuPrimaryTextColor>
		<menuSecondaryColor>{cor secondaria do menu}</menuSecondaryColor>
        <menuSecondaryTextColor>{cor do testo do menu secundario}</menuSecondaryTextColor>
		
		
		<otherTextColor>{cor dos demais textos}</otherTextColor>
		<backgroundColor>{cor de fundo da tela}</backgroundColor>
		<footerColor>{cor do rodapé}</footerColor>
		<linkMainImage>{link do imagem da tela inicial}</linkMainImage>
		<linkMenuImage>{link do imagem do menu principal}</linkMenuImage>		
	</centerAppearance>	
	
</context>';

        $client = new Client([
            'base_uri' => 'http://localhost/Rest-Desarrollo/public/',
        ]);
        $tipo_dato = 'form_params';
        $response = $client->
        request('POST','external',
            [ $tipo_dato =>
                ['data' => $data ]
            ]);
        $body = $response->getBody();
        return $body;

        //return "asd";//"servicio rest para las conexiones externas";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //MyLog::registrar('ingresaron al servicio por POST');
        $salida='hubo un error en el proceso de todo el servicio';
        try{
            $array = Convert::convertXMLtoJSON($request->input('data'));
            $activityHistoricals = $array['historicals']['activityHistorical'];
            //dd($activityHistoricals);
            foreach ($activityHistoricals as $activityHistorical){
                $salida=$activityHistorical;
                //return $salida;
                //dd($activityHistoricals);
            }
            //tengo que obtener la informacion, y procesarla

            //devuelvo un resultado
            return $result='<result>
                        <code>200</code>
                        <message>OK</message>
                        <type>N</type>
                        <entries>
                            <entry>
                                <value>100</value>
                            </entry>
                        </entries>
                    </result>';
        }catch(\Exception $e){
            if($request->input('data') == null){
                //MyLog::registrar('no se enviaron bien los datos al servicio || la variable enviada no tiene el nombre de data');
                return $result='<result>
                                    <code>400</code>
                                    <message>la variable no tiene el nombre de data</message>
                                    <type>N</type>
                                    <entries>
                                        <entry>
                                            <value>0</value>
                                        </entry>
                                    </entries>
                                </result>';
            }
            //MyLog::registrar('hubo alguna excepcion || el Request es el siguiente-> '.$request->input('data'));
            return $result='<result>
                                <code>400</code>
                                <message>ocurrio un problema</message>
                                <type>N</type>
                                <entries>
                                    <entry>
                                        <value>0</value>
                                    </entry>
                                </entries>
                            </result>';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

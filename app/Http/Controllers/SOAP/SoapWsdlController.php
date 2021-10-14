<?php

namespace App\Http\Controllers\SOAP;

use App\Http\Controllers\Controller;

class SoapWsdlController extends Controller
{
    public function wsdl()
    {
        $wsdl = <<< EOL
<?xml version = "1.0" encoding = "UTF-8"?>
<definitions
    name = "UserService"
    targetNamespace = "http://example.com/wsdl/UserService.wsdl"
    xmlns = "http://schemas.xmlsoap.org/wsdl/"
    xmlns:soap = "http://schemas.xmlsoap.org/wsdl/soap/"
    xmlns:xs = "http://www.w3.org/2001/XMLSchema"
    xmlns:tns = "http://example.com/wsdl/UserService.wsdl">

    <types>
        <xs:schema>
            <complexType name = "Post">
                <sequence>
                    <element name = "id" type = "integer" minOccurs = "1"/>
                    <element name = "title" type = "string" minOccurs = "1"/>
                    <element name = "content" type = "string" minOccurs = "1" nillable = "true"/>
                </sequence>
            </complexType>

            <complexType name = "PostList">
                <sequence>
                    <element minOccurs = "0" maxOccurs = "unbounded" name = "post" type = "Post"/>
                </sequence>
            </complexType>

            <complexType name = "User">
                <sequence>
                    <element name = "id" type = "integer" minOccurs = "1"/>
                    <element name = "name" type = "string" minOccurs = "1"/>
                    <element name = "email" type = "string" minOccurs = "1"/>
                    <element name = "image" type = "base64Binary" minOccurs = "1" nillable = "true"/>
                    <element name = "postList" type = "PostList"/>
                </sequence>
            </complexType>

            <element name = "Request">
                <complexType>
                    <sequence>
                        <element name = "id" type = "integer" minOccurs = "1"/>
                    </sequence>
                </complexType>
            </element>

            <element name = "Response">
                <complexType>
                    <sequence>
                        <element name = "user" type = "User"/>
                    </sequence>
                </complexType>
            </element>
        </xs:schema>
    </types>

    <message name = "getUserRequest">
        <part name = "Request" element = "tns:Request"/>
    </message>

    <message name = "getUserResponse">
        <part name = "Response" element = "tns:Response"/>
    </message>

    <portType name = "UserServicePortType">
        <operation name = "getUser">
            <input message = "tns:getUserRequest"/>
            <output message = "tns:getUserResponse"/>
        </operation>
    </portType>

    <binding name = "UserServiceBinding" type = "tns:UserServicePortType">
        <soap:binding style = "rpc" transport = "http://schemas.xmlsoap.org/soap/http"/>
        <operation name = "getUser">
            <soap:operation soapAction = "getUser"/>
            <input>
                <soap:body use = "literal"/>
            </input>
            <output>
                <soap:body use = "literal"/>
            </output>
        </operation>
    </binding>

    <service name = "UserService">
        <port name = "UserServicePort" binding = "tns:UserServiceBinding">
            <soap:address location = "http://nginx/server"/>
        </port>
    </service>
</definitions>
EOL;

        return response($wsdl, 200)
            ->header('Content-Type', 'text/xml; charset=utf-8');
    }
}

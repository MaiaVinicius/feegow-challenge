import React, { Component } from 'react';
import { Navbar, Form, Button, Row, Col } from 'react-bootstrap'
import axios from 'axios'
import headers from '../componentes/cors'
import { hashHistory } from 'react-router'

export default class busca extends Component {
    constructor(props) {
        super(props);

        this.state = {
            data: ''
        }


    }

    componentDidMount() {
        axios.get('http://api.feegow.com.br/api/specialties/list', { headers })
            .then(response => {
                this.setState({ data: response.data.content });
            })
            .catch(e => {
                console.log(e)
            })
    }


    optionsSpecialties() {
        var json = this.state.data;
        var arr = [];
        Object.keys(json).forEach(function (key) {
            arr.push(json[key]);
        });
        console.log(">>>" + arr)
        return (
            <div>
                <Form.Control as="select" name="especialidade" id="especialidade">
                    <option>-- Selecione a Especialidade --</option>
                    {arr.map(item =>
                        <option value={item.especialidade_id}>{item.nome}</option>
                    )}
                </Form.Control>
            </div>
        )
    }

    buscar() {
        hashHistory.push({
            pathname: '/Lista',
            query: { "id": document.getElementById('especialidade').value }
        });
    }

    render() {
        return (
            <div style={{ margin: "200px" }} >
                <Navbar expand="lg" style={{ background: "#4D99D7", borderRadius: "50px" }}>
                    <Row>
                        <Col xs={12}>
                            <Row>
                                <Col xs={4}>
                                    <Navbar.Brand >Consulta de</Navbar.Brand>
                                </Col>
                                <Col xs={5.1}>
                                    <Form inline>
                                        <Form.Group>
                                            {this.optionsSpecialties()}
                                        </Form.Group>
                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </Form>
                                </Col>
                                <Col xs={1}></Col>
                                <Col xs={1}>
                                    <Button variant="success" onClick={this.buscar}>Agendar</Button>
                                </Col>
                            </Row>
                        </Col>
                    </Row>
                </Navbar>
            </div>
        );
    }
}

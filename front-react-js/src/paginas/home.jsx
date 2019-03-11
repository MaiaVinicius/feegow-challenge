import React, { Component } from 'react';
import { Navbar, Form, Button, Row, Col } from 'react-bootstrap'
import axios from 'axios'
import headers from '../componentes/cors'
import { hashHistory } from 'react-router'

export default class home extends Component {
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
        return (
            <div>
                <Form.Control as="select" name="especialidade" id="especialidade">
                    <option value=''>Selecione a Especialidade</option>
                    {arr.map(item =>
                        <option value={item.especialidade_id}>{item.nome}</option>
                    )}
                </Form.Control>
            </div>
        )
    }

    buscar() {
        if (document.getElementById('especialidade').value != '') {
            hashHistory.push({
                pathname: '/Lista',
                query: { "id": document.getElementById('especialidade').value }
            });
            window.location.reload()
        }
    }

    render() {
        return (
            <div style={{ margin: "50px" }} >
                <Navbar style={{ background: "#4D99D7", borderRadius: "5px", justifyContent: 'center', alignItems: 'center' }} variant="dark">
                    <Row >
                        <Col xs={2}>
                            <Navbar.Brand style={{ fontSize: '120%' }}> Consulta de </ Navbar.Brand >
                        </Col>
                        <Col xs={1}>
                        </Col>
                        <Col xs={5}>
                                <Form.Group>
                                    {this.optionsSpecialties()}
                                </Form.Group>
                        </Col>
                        <Col xs={2}>
                        </Col>
                        <Col xs={2}>
                            <Button style={{ borderRadius: "50px", width: '10rem' }} variant="success" onClick={this.buscar}>Agendar</Button>
                        </Col>

                    </Row>
                </Navbar>
            </div>
        );
    }
}

import React, { Component } from 'react';
import headers from '../componentes/cors'
import axios from 'axios'
import FormModal from '../modal/formModal'
import { Card, Button, Row, Col } from 'react-bootstrap'
import Home from './home'

export default class Lista extends Component {
    constructor(props) {
        super(props);

        this.state = {
              id: props.location.query.id
            , data: ''
            , modalShow: false
            , professional_nome: ''
            , profissional_id: ''
        }
    }

    componentDidMount() {
        axios.get('http://api.feegow.com.br/api/professional/list?especialidade_id=' + this.state.id, { headers })
            .then(response => {
                console.log(response.data)
                this.setState({ data: response.data.content });
            })
            .catch(e => {
                console.log(e)
            })
    }

    listarDr() {
        var json = this.state.data;
        var arr = [];
        Object.keys(json).forEach(function (key) {
            arr.push(json[key]);
        });

        return (

            <div>
                <Row style={{ justifyContent: 'center', alignItems: 'center' }}>
                    {arr.map(item =>
                        <Col xs={3} style={{ margin: '1rem' }}>
                            <Row>
                                <Card style={{ width: '15rem', height: '21rem', justifyContent: 'center', alignItems: 'center' }}>
                                    <br />
                                    <Row style={{ width: '7rem', height: '7rem' }}>
                                        <Card.Img style={{ width: '7rem', height: '7rem', borderRadius: "30px" }} variant="top" src={item.foto} roundedCircle />
                                    </Row>

                                    <Card.Body>
                                        <br />
                                        <Row style={{ width: '10rem', height: '10rem', justifyContent: 'center', alignItems: 'center' }}>
                                            <label><b><u>{item.nome}</u></b></label>
                                            <br />
                                            <Card.Text>
                                                {item.conselho + ':'}{item.documento_conselho}
                                            </Card.Text>
                                        </Row>
                                        <Row style={{ width: '10rem', height: '2rem', justifyContent: 'center', alignItems: 'center' }}>
                                            <Button variant="success" onClick={() => this.setState({ modalShow: true, professional_nome: item.nome, profissional_id: item.profissional_id })} style={{ width: '120px', borderRadius: '20px' }}>Agendar</Button>
                                        </Row>
                                    </Card.Body>
                                </Card>
                            </Row>
                        </Col>
                    )}
                </Row>
            </div>
        )
    }


    render() {
        let modalClose = () => this.setState({ modalShow: false })
        console.log(this.state.data)
        return (
            <div>
                <Home/>
                {this.listarDr()}
                <FormModal
                    show={this.state.modalShow}
                    onHide={modalClose}
                    profissional_id = {this.state.profissional_id}
                    professional_nome = {this.state.professional_nome}
                    specialty_id = {this.state.id}
                />
            </div>
        )

    }

}

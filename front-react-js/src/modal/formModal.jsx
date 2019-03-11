import React, { Fragment } from 'react';
import headers from '../componentes/cors'
import axios from 'axios'
import { Modal, Button, Form, Col } from 'react-bootstrap'

export default class FormModal extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      data: ''
    }
  }

  componentDidMount() {
    axios.get('http://api.feegow.com.br/api/patient/list-sources', { headers })
      .then(response => {
        this.setState({ data: response.data.content });
      })
      .catch(e => {
        console.log(e)
      })
  }


  listsources() {
    var json = this.state.data;
    var arr = [];
    Object.keys(json).forEach(function (key) {
      arr.push(json[key]);
    });

    return (
      <div>
        <Form.Control as="select" name="listsources" id="listsources">
          <option value=''>Como conheceu?</option>
          {arr.map(item =>
            <option value={item.origem_id}>{item.nome_origem}</option>
          )}
        </Form.Control>
      </div>
    )
  }



  render() {
    let submitFrom = () => {
      let data = {
        'specialty_id': this.props.specialty_id
        , 'profissional_id': this.props.profissional_id
        , 'cpf': document.getElementById('cpf').value
        , 'nome': document.getElementById('nome').value
        , 'birthdate': document.getElementById('nascimento').value
        , 'listsources': document.getElementById('listsources').value

      }
      axios.post('http://127.0.0.1:8000/agendarHorario', { data })
        .then(response => {
          console.log(response.data)
          window.location.reload()
        })
        .catch(e => {
          console.log(e)
        })

    }
    return (
      <Modal
        {...this.props}
        size="lg"
        aria-labelledby="contained-modal-title-vcenter"
        centered
      >

      
        <Modal.Header closeButton>
          <Modal.Title id="contained-modal-title-vcenter">
            Preencha seus dados
            </Modal.Title>
        </Modal.Header>
        <Modal.Body />
        <Form style={{ margin: "2rem" }}>
          <Form.Row>
            <Col>
              <Form.Control maxlength="30" placeholder="Nome Completo" name="nome" id="nome" required="required" />
            </Col>
            <Col>
              {this.listsources()}
            </Col>
          </Form.Row>
          <br />
          <Form.Row>
            <Col>
              <Form.Control type="date" placeholder="Nascimento" name="nascimento" id="nascimento" required="required" />
            </Col>
            <Col>
              <Form.Control type="text" maxlength="10" placeholder="CPF" name="cpf" id="cpf" required="required" />
            </Col>
          </Form.Row>
        </Form>

        <Modal.Footer>
          <Button variant="success" onClick={submitFrom}>SOLICITAR HORÁRIO</Button>
          <Button onClick={this.props.onHide}>Fechar</Button>
        </Modal.Footer>
      </Modal>
    );
  }
}


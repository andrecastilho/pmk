<style scoped>
  fieldset {
    padding: 42px;
    
  }
  input {
    padding: 0.3%;
    position:relative;
  }
  .form-group{
    padding: 1%;
  }
  label{
    padding: 1%;
  }
</style>


<template>

  <form @submit.prevent="form.post('/doadores/save')">
   
    <fieldset>
        <legend>Formulário</legend>

        <div class="form-group">
          <label for="nome">Nome</label>
            <input class="form-control form-control-lg" @input="checkForm" type="text" name="nome" placeholder="Seu Nome" v-model="form.nome">
          <div v-if="form.errors.nome">{{ form.errors.nome }}</div>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input class="form-control form-control-lg" @input="checkForm"  type="text" name="email" placeholder="Seu Email" v-model="form.email">
          <div v-if="form.errors.email">{{ form.errors.email }}</div><br>
        </div>

        <div class="form-group">
          <label for="email">Cpf</label>
          <input class="form-control form-control-lg" @input="checkForm"  type="text" name="cpf" placeholder="Seu Cpf" v-model="form.cpf">
          <div v-if="form.errors.cpf">{{ form.errors.cpf }}</div>
        </div>

          <div class="form-group">
            <label for="telefone">Celular</label>
            <input class="form-control form-control-lg" @blur="checkForm" @input="acceptNumber"  type="tel" name="telefone" placeholder="Seu Telefone" v-model="form.telefone">
            <div v-if="form.errors.telefone">{{ form.errors.telefone }}</div>
          </div>

          <div class="form-group">
            <label for="dt_nascimento">Data Nascimento</label>
            <input class="form-control form-control-lg" @input="checkForm" type="date" name="dt_nascimento" placeholder="Sua Data de Nascimento" v-model="form.dt_nascimento">
            <div v-if="form.errors.dt_nascimento">{{ form.errors.dt_nascimento }}</div>
          </div>

          <div class="form-group">
            <label for="dt_cadastro">Data Cadastro</label>
            <input class="form-control form-control-lg" @input="checkForm" type="date" name="dt_cadastro" placeholder="Sua Data de Cadastro" v-model="form.dt_cadastro">
            <div v-if="form.errors.dt_cadastro">{{ form.errors.dt_cadastro }}</div>
          </div>

          <div class="form-group">
            <label for="intervalo_doacao">Intervalo Doação</label>
            <select @change="checkForm" v-model="form.intervalo_doacao" name="intervalo_doacao">
              <option value="0" >Selecione um Intervalo</option>
              <option value="Único">Único</option>
              <option value="Bimestal">Bimestal</option>
              <option value="Semestral">Semestral</option>
              <option value="Anual">Anual</option>
            </select>
          </div>

          <div class="form-group">
            <label for="forma_pagamento">Forma Pagamento</label>
            <select @change="checkForm"  v-model="form.forma_pagamento" name="forma_pagamento">
                <option value="0">Selecione Forma de Pagamento</option>
                <option value="Débito">Débito</option>
                <option value="Crédito">Crédito</option>
              </select>
          </div>

          <div class="form-group">
          <label for="endereco">Endereço</label>
          <input @input="checkForm" class="form-control form-control-lg" type="fone" name="endereco" placeholder="Endereço completo" v-model="form.endereco">
          <div v-if="form.errors.endereco">{{ form.errors.endereco }}</div>
          </div>

          <div class="form-group">
          <label for="vl_doacao">Valor Doacao</label>
          <input @input="checkForm"  class="form-control form-control-lg"  type="number"  name="vl_doacao" placeholder="Valor da doação"  v-model="form.vl_doacao">
          <div v-if="form.errors.vl_doacao">{{ form.errors.vl_doacao }}</div>
          </div>

          <p v-if="errors.length">
            <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
              <ul>
                <li v-for="error in errors">{{ error }}</li>
              </ul>
          </p>
        
          <!-- submit -->
          <button @input="checkForm" :disabled="form.nome === null" type="submit" >Enviar</button>  
          <button type="button" >Voltar</button>  
        </fieldset>
    </form>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

const form = defineComponent({
        nome:null,
        email:null,
        cpf:null ,
        telefone:null,
        dt_nascimento:null,
        dt_cadastro:null,
        intervalo_doacao:null,
        vl_doacao:null,
        forma_pagamento:null,
        endereco:null
})

export default defineComponent({
  data() {
    return {
    errors: [],
      form: this.$inertia.form({
        nome:form.nome,
        email:form.email,
        cpf:form.cpf ,
        telefone:form.telefone,
        dt_nascimento:form.dt_nascimento,
        dt_cadastro:form.dt_cadastro,
        intervalo_doacao:form.intervalo_doacao,
        vl_doacao:form.vl_doacao,
        forma_pagamento:form.forma_pagamento,
        endereco:form.endereco
      }),
    }
  },
  methods: {
    checkForm: function (e) {
     
      console.log(this.form.nome ? this.errors.push("Nome obrigatório"): 0);

      this.errors = [];


     

    
      if (!this.form.nome) {
        this.errors.push('O nome é obrigatório.');
      }

      if (!this.form.email) {
        this.errors.push('O e-mail é obrigatório.');
      } else if (!this.validEmail(this.form.email)) {
        this.errors.push('Utilize um e-mail válido.');
      }

      if (!this.form.cpf) {
        this.errors.push('O CPF é obrigatório.');
      }
      if (!this.form.telefone) {
        this.errors.push('O celular é obrigatório.');
      }
       if (!this.form.dt_nascimento) {
        this.errors.push('A data de nascimento é obrigatório.');
      }

       if (!this.form.dt_cadastro) {
        this.errors.push('A data do cadastro é obrigatório.');
      }
       if (!this.form.intervalo_doacao) {
        this.errors.push('Intervalo de doação obrigatório.');
      }
       if (!this.form.forma_pagamento) {
        this.errors.push('Forma de pagamento obrigatório.');
      }
     
       if (!this.form.endereco) {
        this.errors.push('Endereço completo obrigatório.');
      }
       if (!this.form.vl_doacao) {
        this.errors.push('Valor doação obrigatório.');
      }

      e.preventDefault();
    },
    acceptNumber() {
        var x = this.form.telefone.replace(/\D/g, '').match(/(\d{0,2})(\d{0,4})(\d{0,5})/);
        console.log(x);
        this.form.telefone = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    },

    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

  }

})
</script>
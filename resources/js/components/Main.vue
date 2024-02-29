<template>
    <section class="w-100">
        <nav class="navbar navbar-dark bg-dark mb-5 p-3">
            <a class="navbar-brand" href="#">Administrador de gastos</a>
            <ul class="d-flex flex-row navbar-nav">
                <li class="nav-item active p-3">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span><i class="pi pi-home"></i></a>
                </li>
                <li class="nav-item p-3">
                    <a class="nav-link" href="#">Salir <i class="pi pi-lock"></i></a>
                </li>
            </ul>
        </nav>
        <LoginForm v-if="!token"/>
        <App v-if="token"/>
    </section>
</template>

<script>

import App from './App.vue';
import LoginForm from './LoginForm.vue';
import { getToken, removeToken } from '../services/mainService';

export default {
    data() {
        return {
            token: null
        };
    },
    components: {
        LoginForm,
        App
    },
    mounted(){
        this.token = getToken();
    },
    methods: {
        logout(){

        }
    }
}

</script>
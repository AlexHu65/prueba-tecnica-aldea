<template>
    <section class="w-100">
        <nav class="navbar navbar-dark bg-dark mb-5 p-3">
            <a class="navbar-brand" href="#">Administrador de gastos</a>
            <ul class="d-flex flex-row navbar-nav">
                <li class="nav-item active p-3">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span><i class="pi pi-home"></i></a>
                </li>
                <li class="nav-item p-3">
                    <a href="#" @click="logout()" class="nav-link">Salir <i class="pi pi-lock"></i></a>
                </li>
            </ul>
        </nav>
        <div v-if="loading" class="d-flex flex-column align-items-center justify-content-center pt-4 pb-4">
            <i  class="pi pi-spin pi-spinner" style="font-size: 5rem; color: green"></i>
            <span class="s20 m-4 font-weight-bold">
            Redireccionando ...
            </span>
        </div>
        <LoginForm v-if="!token && !loading"/>
        <App v-if="token && !loading"/>
    </section>
</template>

<script>

import App from './App.vue';
import LoginForm from './LoginForm.vue';
import { getToken, removeToken } from '../services/mainService';

export default {
    data() {
        return {
            token: null,
            loading: false
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
            
            this.loading = true;

            this.token = null;

            removeToken();

            setTimeout(() => {
                this.loading = false;
            }, 2500)
        }
    }
}

</script>
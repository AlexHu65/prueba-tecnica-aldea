<template>
    <section class="w-100">
        <NavBar @loading-evnt="((e) => setLoad(e))"/>
        <LoginForm v-if="!token && !loading"/>
        <App v-if="token && !loading"/>
    </section>
</template>

<script>

import App from './App.vue';
import LoginForm from './LoginForm.vue';
import NavBar from './shared/NavBar.vue';
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
        App,
        NavBar
    },
    mounted(){
        this.token = getToken();
    },
    methods:{
        setLoad(e){
            this.loading = e;
            setTimeout(() => {
                window.location.reload();
            }, 1200);
        },
    }
}

</script>
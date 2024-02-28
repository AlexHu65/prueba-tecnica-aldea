<template>
    <section class="w-90 pt-5 pb-5">
        <div class="container">
            <LoginForm v-if="!token"/>
            <App v-if="token"/>
        </div>
    </section>
</template>

<script>

import App from './App.vue';
import LoginForm from './LoginForm.vue';
import { getToken } from '../services/mainService';

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
    }
}

</script>
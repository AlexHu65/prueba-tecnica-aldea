<template>
    <NavBar @loading-evnt="((e) => setLoad(e))"/>
    <div class="row justify-content-center p-0 m-0">
        <div v-if="token" class="col-12">
            <h1>Conteo por categoría:</h1>
            <div v-if="data && !loading">
                <ul>
                    <li v-for="item in data">
                      {{ item.name }} - {{ item.count }}
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>

import { getToken, removeToken } from '../services/mainService';
import categoryService from '../services/categoryService';
import NavBar from './shared/NavBar.vue';

export default {
    components:{
        NavBar
    },
    data() {
        return {
            data: null,
            token: null,
            loading: false
        };
    },
    mounted(){
        this.token = getToken();
        if(!this.token){
            window.location.href('/');
        }
        this.getStats();
    },
    methods:{
        getStats(){
            categoryService.get('stats/bills')
                .then((response) => {
                    if(response.data.status){
                        const { data } = response.data;
                        this.data = data;
                    }
                })
            .catch(console.warn)
        },
        setLoad(e){
            this.loading = e;
            setTimeout(() => {
                window.href = '/';
            }, 1200);
        },
    }
}

</script>
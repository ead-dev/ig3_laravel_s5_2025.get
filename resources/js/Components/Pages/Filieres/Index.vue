<template>
    <Display>
        <template v-slot:breadcrumb>
          <BreadCrumb :link_1="{name:'GESTION DES FILIERES',path:'/filieres'}" :link_2="'LISTE DES FILIERES'"></BreadCrumb>
        </template>
        <template v-slot:page-header>
            <PageHeader :p="description" :h1="'GESTION DES FILIERES'" ></PageHeader>
        </template>
        <template v-slot:content>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h2>GESTION DES FILIERES</h2>
                        <router-link class="btn btn-primary" to="/filieres/create"><i class="demo-pli-add me-1 fs-5"></i> NOUVELLE FILIERE</router-link>
                    </div>
                    <div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>FILIERE</th>
                                    <th>CODE</th>
                                    <th>CYCLE</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="filiere in filieres" :key="filiere.id">
                                    <td>{{ filiere.name }}</td>
                                    <td>{{ filiere.code }}</td>
                                    <td>{{ filiere.cycle.name }}</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </template>
    </Display>

</template>

<script>
import {mapActions} from 'vuex'
import Display from '@/Components/Layout/Display.vue';
import PageHeader from '@/Components/Layout/Includes/PageHeader.vue';
import BreadCrumb from '@/Components/Layout/Includes/Breadcrumb.vue';
export default {
    name:"InscriptionIndex",
    ...mapActions({
        logout:"logOut"
    }),
    components:{
        Display,
        PageHeader,
        BreadCrumb,

    },
    data(){
        return {
            user:this.$store.state.user,
            description:'Liste des filieres de l\'ecole',
            filieres:[],
        }
    },
    methods:{
      async load(){
            //await this.$store.dispatch('ecoleCreate')
            await this.api.get('/api/filieres')
            .then((res)=>{
                console.log(res.data);
                this.filieres = res.data;
            })
            .catch((err)=>{
                console.log(err);
            })
            .finally(()=>{
                //this.$router.push({path:'/login'});
            })

        }
    },
    mounted(){
        this.load();
    }

}
</script>

<style scoped>

</style>

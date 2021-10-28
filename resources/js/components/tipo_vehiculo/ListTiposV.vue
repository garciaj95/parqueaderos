<template>
    <div>
        <h2 class="text-center">Listado de Tipos de Vehículos</h2>
 
        <div class="col-md-12 text-right">
            <router-link :to="{name: 'tipov_create'}" class="nav-item nav-link">Nuevo Tipo</router-link>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th></th>
                </tr>
                </thead>
                <tbody v-if="verificarListado">
                    <tr v-for="tipo in tipos" :key="tipo.id">
                        <td>{{ tipo.id }}</td>
                        <td>{{ tipo.descripcion }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <router-link :to="{name: 'tipov_edit', params: { id: tipo.id }}" class="btn btn-primary">
                                    <i class="fa fa-pencil"></i>
                                </router-link>
                                <button class="btn btn-danger" @click="deleteTipoV(tipo.id)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                tipos: []
            }
        },
        computed: {
            verificarListado() {
                return this.tipos.length > 0
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/tipos/')
                .then(response => {
                    this.tipos = response.data;
                });
        },
        methods: {
            deleteTipoV(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/tipos/${id}`)
                    .then(response => {
                        let i = this.tipos.map(data => data.id).indexOf(id);
                        this.tipos.splice(i, 1)
                    });
            }
        }
    }
</script>
<template>
    <div>
        <h2 class="text-center">Listado de Propietarios</h2>

        <div class="col-md-12 table-responsive">
            <table class="table" >
                <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>Cantidad Vehículos</th>
                    <th></th>
                </tr>
                </thead>
                <tbody v-if="verificarListado">
                    <tr v-for="propi in propietarios" :key="propi.id">
                        <td>{{ propi.identificacion }}</td>
                        <td>{{ propi.nombres }}</td>
                        <td>{{ propi.email }}</td>
                        <td>{{ propi.vehiculos.length }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
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
                propietarios: []
            }
        },
        computed: {
            verificarListado() {
                return this.propietarios.length > 0
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/listado-propietarios/')
                .then(response => {
                    this.propietarios = response.data;
                });
        },
        methods: {
        }
    }
</script>
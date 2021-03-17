<template>
    <div class="admin-pages">
        <PageTitle icon="fa fa-cogs" main="Sistema de Agendamento"
             />
        <div class="admin-pages-tabs">
            <b-card no-body>
                <b-tabs card>
                    <b-tab title="Consultar" active>
                        <Scheduling />
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>
    </div>
</template>

<script>
import PageTitle from '../template/PageTitle'
import Scheduling from './Scheduling'


export default {
    name: 'AdminPages',
    components: { PageTitle, Scheduling}
}
</script>

<style>

</style>

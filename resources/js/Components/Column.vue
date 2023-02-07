<template>
    <div class="column">
        <span>
            {{ column.title }}
        </span>
        <DeleteColumnButton :columnId="column.id" />
        <Card v-for="card in column.cards" :key="card.id" :card="card" />
        <CreateCardForm :columnId="column.id" />
    </div>
</template>

<script>
import CreateCardForm from "./CreateCardForm.vue";
import DeleteColumnButton from "./DeleteColumnButton.vue";
import Card from "./Card.vue";

export default {
    components: { Card, CreateCardForm, DeleteColumnButton },
    props: {
        column: Object,
    },
};
</script>

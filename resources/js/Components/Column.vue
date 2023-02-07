<template>
    <div class="column">
        <span>
            {{ column.title }}
        </span>
        <DeleteColumnButton :columnId="column.id" />
        <draggable
            :list="cards"
            group="cards"
            v-bind="dragOptions"
            @change="updateCardsOrder">
            <Card v-for="card in cards" :key="card.id" :card="card" />
        </draggable>
        <CreateCardForm :columnId="column.id" />
    </div>
</template>

<script>
import CreateCardForm from "./CreateCardForm.vue";
import DeleteColumnButton from "./DeleteColumnButton.vue";
import Card from "./Card.vue";
import draggable from "vuedraggable";
import { useForm } from "@inertiajs/vue2";

export default {
    components: { Card, CreateCardForm, DeleteColumnButton, draggable },
    props: {
        column: Object,
    },
    data() {
        return {
            dragOptions: {
                animation: 150,
                disabled: false,
                ghostClass: "ghost",
            },
            cards: [],
        };
    },
    mounted() {
        this.cards = this.sortCards(this.column.cards);
    },
    methods: {
        updateCardsOrder() {
            const cardsToUpdate = this.cards.map((card, index) => {
                return {
                    id: card.id,
                    column_id: this.column.id,
                    title: card.title,
                    order: index,
                };
            });

            this.cards = this.sortCards(cardsToUpdate);

            cardsToUpdate.forEach((card) => {
                console.log(
                    `Card ${card.title} moved to ${card.order} and column ${card.column_id}`
                );
            });

            useForm({
                cards: cardsToUpdate,
            }).post("/cards/order", {
                preserveScroll: true,
            });
        },
        sortCards(cards) {
            return cards.sort((a, b) => a.order - b.order);
        },
    },
};
</script>

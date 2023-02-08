<template>
    <div class="column">
        <div>
            <span class="title">
                {{ column.title }}
            </span>
            <DeleteColumnButton :columnId="column.id" />
        </div>
        <draggable
            v-model="cards"
            group="cards"
            @add="cardAddedToColumn"
            @update="updateCardsOrder">
            <Card v-for="card in cards" :key="card.id" :card="card" />
        </draggable>
        <CreateCardForm :columnId="column.id" />
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue2";
import draggable from "vuedraggable";
import Card from "./Card.vue";
import CreateCardForm from "./CreateCardForm.vue";
import DeleteColumnButton from "./DeleteColumnButton.vue";

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
            cards: this.column.cards,
        };
    },
    mounted() {
        this.updateCards(this.column.cards);
    },
    watch: {
        column: {
            handler: function (newColumn) {
                this.updateCards(newColumn.cards);
            },
        },
    },
    methods: {
        updateCards(cards) {
            this.cards = this.sortCards(cards);
        },
        sortCards(cards) {
            return cards.sort((a, b) => a.order - b.order);
        },
        updateCardsOrder() {
            const cardsToUpdate = this.cards.map((card, index) => {
                card.column_id = this.column.id;
                card.order = index;
                return card;
            });

            useForm({
                cards: cardsToUpdate,
            }).post("/cards/order", {
                preserveScroll: true,
            });

            this.cards = this.sortCards(cardsToUpdate);
        },
        cardAddedToColumn(event) {
            const index = event.newIndex;
            const card = this.cards[index];
            card.column_id = this.column.id;
            card.order = index;

            useForm({
                card_id: card.id,
                column_id: card.column_id,
                order: card.order,
            }).post("/cards/add", {
                preserveScroll: true,
            });
        },
    },
};
</script>

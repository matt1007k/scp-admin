import Alpine from "alpinejs";
import { ImportPayment, ImportPeople, ImportJudicials } from "./components";

window.Alpine = Alpine;

Alpine.data("ImportPayment", ImportPayment);
Alpine.data("ImportPeople", ImportPeople);
Alpine.data("ImportJudicials", ImportJudicials);

Alpine.start();

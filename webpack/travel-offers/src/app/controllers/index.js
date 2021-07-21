import 'bootstrap/dist/css/bootstrap.css';

// Already exist
import OfferService from '../services/offer';

class IndexController {

    _offersContainer;

    constructor() {
        this._initSelector();
        this._generateHTML();
    }

    _initSelector() {
        this._offersContainer = document.querySelector('#offers');
    }

    _generateHTML() {
        OfferService.offers.forEach(offer => {

            const offerElem =
                `<div class="card mb-3 h-100">
                    <div class="row g-0">
                        <div class="col-md-4 mx-auto">
                            <img src="../assets/images/${offer.imageName}" style="width: 300px">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">${offer.name}</h5>
                                <p class="card-text">${offer.description}</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Offre disponible du ${offer.dateBeginFormatted()} au ${offer.dateEndFormatted()}
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2 align-self-center">
                            <a href="details.html?id=${offer.id}" class="btn btn-dark btn-lg">DÉTAILS</a>
                        </div>
                    </div>
                </div>`;

            this._offersContainer.innerHTML += offerElem;

        });
    }
}

// Generate the instance
new IndexController();

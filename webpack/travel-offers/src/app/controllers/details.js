import 'bootstrap/dist/css/bootstrap.css';

// Already exist
import OfferService from '../services/offer';

class DetailsController {

    _offerContainer;
    _offer;

    constructor() {
        this._initSelector();
        this._getOffer();
        this._generateHTML();
    }

    _initSelector() {
        this._offerContainer = document.querySelector('.container');
    }

    _getOffer() {
        const id = parseInt(window.location.search.substr(1).split('=')[1]);
        this._offer = OfferService.findOneById(id);
    }

    _generateHTML() {
        const offerElem =
            `<div class="px-4 pt-5 my-5 text-center">
                <h1 class="display-4 fw-bold">${this._offer.name}</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">${this._offer.description}</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                        <small class="text-muted">
                            Offre disponible du ${this._offer.dateBeginFormatted()} au ${this._offer.dateEndFormatted()}
                        </small>
                    </div>
                </div>
                <div class="px-5">
                    <img src="../assets/images/${this._offer.imageName}" class="img-fluid border rounded-3 shadow-lg mb-4"
                         width="700" height="500">
                </div>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <a href="index.html" class="btn btn-outline-dark">RETOUR</a>
                </div>    
            </div>`;

        this._offerContainer.innerHTML += offerElem;
    }
}

// Generate the instance
new DetailsController();
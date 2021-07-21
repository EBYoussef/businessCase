import Offer from '../entities/offer';

class OfferService {

    _offers;

    static instance;

    constructor() {

        if (!OfferService.instance) {

            const offers = JSON.parse(localStorage.getItem('offers'));

            if (!offers) {
                this._offers = [];
                this._loadData();

                localStorage.setItem('offers', JSON.stringify(this._offers));
            } else {
                this._offers = offers.map(offer => Offer.fromJSON(offer));
            }
            OfferService.instance = this;
        }

        return OfferService.instance;
    }

    get offers() {
        return this._offers;
    }

    findOneById(searchId) {
        return this._offers.find(o => o.id === searchId);
    }

    _loadData() {
        this._offers.push(new Offer('Crète', 'Vivez une expérience incroyable en Crète', 'crete.jpeg'));
        this._offers.push(new Offer('Croatie', 'Vivez une expérience incroyable en Croatie', 'croatie.jpeg'));
        this._offers.push(new Offer('Malte', 'Vivez une expérience incroyable en Malte', 'malte.jpeg'));
        this._offers.push(new Offer('Montenegro', 'Vivez une expérience incroyable en Montenegro', 'montenegro.jpeg'));
    }

}

// Try to create a new object, if an instance already exsist, it will be returned
const offerService = new OfferService();

// Freeze the object retrieved => the method and properties can't be changed or override
Object.freeze(offerService);

// Just export the instance
export default offerService;
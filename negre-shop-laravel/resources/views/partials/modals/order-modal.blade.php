{{--
    Modal de commande réutilisable
    
    @param string $modalId - ID unique du modal (défaut: 'orderModal')
    @param string $formId - ID du formulaire (défaut: 'orderForm')
    @param string $formAction - Action du formulaire
--}}

<div id="{{ $modalId ?? 'orderModal' }}" class="order-modal">
    <div class="order-modal-content">
        <button class="detail-close" onclick="closeOrderModal()">✕</button>
        
        <h2>{{ $modalContent->order_title ?? 'Commander' }}</h2>
        
        <form id="{{ $formId ?? 'orderForm' }}" action="{{ $formAction ?? route('order.store') }}" method="POST">
            @csrf
            <input type="hidden" id="product_id" name="product_id">
            
            <div class="form-group">
                <label for="customer_name">{{ $modalContent->order_label_name ?? 'Nom' }}</label>
                <input type="text" id="customer_name" name="customer_name" required>
            </div>
            
            <div class="form-group">
                <label for="customer_email">{{ $modalContent->order_label_email ?? 'Email' }}</label>
                <input type="email" id="customer_email" name="customer_email" required>
            </div>
            
            <div class="form-group">
                <label for="customer_phone">{{ $modalContent->order_label_phone ?? 'Téléphone' }}</label>
                <input type="tel" id="customer_phone" name="customer_phone" required>
            </div>
            
            <div class="form-group">
                <label for="message">{{ $modalContent->order_label_message ?? 'Message' }}</label>
                <textarea id="message" name="message" readonly></textarea>
            </div>
            
            <button type="submit" class="submit-btn" id="submitBtn">
                {{ $modalContent->order_button_submit ?? 'Envoyer' }}
            </button>
        </form>
    </div>
</div>

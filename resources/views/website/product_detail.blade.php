@extends('Layouts.webmaster')

@section('detail-content')

<style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: #1e293b;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        min-height: 100vh;
    }

    .product-title {
        color: #0f172a;
        font-weight: 800;
        font-size: 2.75rem;
        letter-spacing: -0.025em;
        line-height: 1.2;
        position: relative;
        margin-bottom: 2rem;
        background: linear-gradient(90deg, #0f172a 0%, #334155 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .product-title:after {
        content: '';
        position: absolute;
        bottom: -0.75rem;
        left: 0;
        width: 120px;
        height: 5px;
        background: linear-gradient(90deg, #FFD700, #FFED4E, #FFD700);
        border-radius: 3px;
        animation: shine 3s ease-in-out infinite;
    }

    @keyframes shine {
        0%, 100% { width: 120px; }
        50% { width: 150px; }
    }

    .product-card {
        background: #ffffff;
        border-radius: 28px;
        padding: 3rem;
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.08),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.9),
            0 0 0 1px rgba(255, 215, 0, 0.08);
        border: 1px solid rgba(255, 215, 0, 0.15);
        backdrop-filter: blur(20px);
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .product-card:before {
        content: '';
        position: absolute;
        top: -2rem;
        left: -2rem;
        right: -2rem;
        bottom: -2rem;
        background: radial-gradient(circle at 30% 30%, rgba(255, 215, 0, 0.05) 0%, transparent 60%);
        z-index: 0;
        pointer-events: none;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 
            0 40px 80px rgba(0, 0, 0, 0.12),
            0 0 0 1px rgba(255, 215, 0, 0.2);
    }

    /* Advanced Image Container with 3D Parallax Effect */
    .image-container-wrapper {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        transform-style: preserve-3d;
        perspective: 1500px;
        box-shadow: 
            0 30px 60px -12px rgba(0, 0, 0, 0.18),
            0 20px 40px -12px rgba(0, 0, 0, 0.12),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.5);
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        padding: 1.5rem;
    }

    .image-container {
        position: relative;
        width: 100%;
        height: 500px;
        border-radius: 16px;
        overflow: hidden;
        transform: rotateX(0) rotateY(0);
        transition: transform 0.3s ease-out;
        will-change: transform;
        cursor: grab;
    }

    .image-container:active {
        cursor: grabbing;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
        transform: scale(1.05);
        filter: brightness(1.02) contrast(1.02);
    }

    .image-container:hover img {
        transform: scale(1.08);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, transparent 0%, transparent 85%, rgba(0, 0, 0, 0.1) 100%);
        pointer-events: none;
        border-radius: 16px;
    }

    /* Price Tag - Premium Design */
    .price-tag-wrapper {
        position: relative;
        display: inline-block;
    }

    .price-tag {
        font-size: 2.75rem;
        font-weight: 800;
        color: #0f172a;
        background: linear-gradient(135deg, #ffffff 0%, #fefce8 100%);
        padding: 1.25rem 2.5rem;
        border-radius: 16px;
        display: inline-block;
        box-shadow: 
            0 10px 30px rgba(255, 215, 0, 0.2),
            inset 0 2px 0 0 rgba(255, 255, 255, 0.8),
            0 0 0 1px rgba(255, 215, 0, 0.2);
        position: relative;
        overflow: hidden;
        border: 2px solid #FFED4E;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .price-tag:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s ease;
    }

    .price-tag:hover:before {
        left: 100%;
    }

    .price-tag:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 
            0 20px 40px rgba(255, 215, 0, 0.3),
            inset 0 2px 0 0 rgba(255, 255, 255, 0.9),
            0 0 0 2px rgba(255, 215, 0, 0.3);
    }

    /* Premium Button */
    .btn-yellow {
        background: linear-gradient(135deg, #FFD700 0%, #FFED4E 100%);
        color: #0f172a;
        font-weight: 700;
        border-radius: 14px;
        padding: 1.25rem 3rem;
        border: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 
            0 15px 35px rgba(255, 215, 0, 0.25),
            inset 0 2px 0 0 rgba(255, 255, 255, 0.6);
        font-size: 1.125rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .btn-yellow:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s ease;
        z-index: -1;
    }

    .btn-yellow:hover {
        background: linear-gradient(135deg, #FFC400 0%, #FFE44D 100%);
        color: #000;
        transform: translateY(-6px) scale(1.02);
        box-shadow: 
            0 25px 50px rgba(255, 215, 0, 0.4),
            inset 0 2px 0 0 rgba(255, 255, 255, 0.7);
    }

    .btn-yellow:hover:before {
        left: 100%;
    }

    .btn-yellow:active {
        transform: translateY(-3px) scale(0.98);
    }

    /* Enhanced Description */
    .long-description {
        color: #475569;
        line-height: 1.8;
        font-size: 1.125rem;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        padding: 2.5rem;
        border-radius: 18px;
        border-left: 6px solid #FFD700;
        box-shadow: 
            inset 0 2px 4px rgba(0, 0, 0, 0.05),
            0 10px 30px rgba(0, 0, 0, 0.05);
        margin: 2rem 0;
        position: relative;
        overflow: hidden;
    }

    .long-description:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #FFD700, #FFED4E);
    }

    /* Professional Tags */
    .product-highlight {
        background: linear-gradient(135deg, #FFED4E 0%, #FFD700 100%);
        color: #0f172a;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-right: 0.75rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .product-highlight:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
    }

    /* Divider */
    .section-divider {
        height: 2px;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 215, 0, 0.2), 
            rgba(255, 215, 0, 0.6), 
            rgba(255, 215, 0, 0.2), 
            transparent);
        margin: 2.5rem 0;
        border: none;
        position: relative;
    }

    .section-divider:after {
        content: '✦';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #ffffff;
        color: #FFD700;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-size: 1.25rem;
    }

    /* Floating Action Badge */
    .floating-badge {
        position: absolute;
        top: 2rem;
        right: 2rem;
        background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
        color: #FFD700;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.875rem;
        letter-spacing: 1px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 10;
        animation: float 3s ease-in-out infinite;
        border: 2px solid rgba(255, 215, 0, 0.3);
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
</style>

<div class="container py-5">
    <div class="product-card position-relative">
        
        <!-- Floating Badge -->
        <div class="floating-badge">🚀 PREMIUM</div>
        
        <div class="row align-items-stretch g-5">
            
            <!-- IMAGE SECTION with Advanced Parallax -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="image-container-wrapper">
                    <div class="image-container" id="productImage3D">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             class="img-fluid" 
                             alt="{{ $product->name }}"
                             id="productImage">
                        <div class="image-overlay"></div>
                    </div>
                </div>
            </div>

            <!-- PRODUCT DETAILS -->
            <div class="col-lg-6">
                <div class="product-details-container h-100 d-flex flex-column">
                    <div class="flex-grow-1">
                        <h1 class="product-title mb-4">{{ $product->name }}</h1>
                        
                        <!-- Premium Tags -->
                        <div class="mb-4">
                            <span class="product-highlight">
                                <i class="bi bi-star-fill"></i> Premium Quality
                            </span>
                            <span class="product-highlight">
                                <i class="bi bi-lightning-fill"></i> Limited Stock
                            </span>
                            <span class="product-highlight">
                                <i class="bi bi-truck"></i> Free Shipping
                            </span>
                        </div>

                        <hr class="section-divider">

                        <!-- Price with Animation -->
                        <div class="mb-5">
                            <div class="price-tag-wrapper">
                                <p class="price-tag mb-0">
                                    Rs {{ number_format($product->price) }}
                                </p>
                            </div>
                            <small class="text-muted d-block mt-2 ms-1">
                                *Inclusive of all taxes
                            </small>
                        </div>

                        <!-- Enhanced Description -->
                        <div class="mb-5">
                            <h4 class="mb-3 fw-bold" style="color: #0f172a;">Product Details</h4>
                            <div class="long-description">
                                {!! nl2br(e($product->long_description)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- ADD TO CART FORM with Premium Button -->
                    <div class="mt-auto pt-4">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="btn btn-yellow w-100">
                                <i class="bi bi-cart-plus-fill"></i>
                                <span>ADD TO CART</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>
                        <p class="text-center text-muted mt-3 small">
                            <i class="bi bi-shield-check"></i>
                            30-Day Money Back Guarantee
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for 3D Image Parallax Effect -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageContainer = document.getElementById('productImage3D');
    const image = document.getElementById('productImage');
    
    if (!imageContainer || !image) return;

    let isDragging = false;
    let currentX = 0;
    let currentY = 0;
    let initialX = 0;
    let initialY = 0;
    let xOffset = 0;
    let yOffset = 0;

    // Mouse events for desktop
    imageContainer.addEventListener('mousedown', dragStart);
    imageContainer.addEventListener('mouseup', dragEnd);
    imageContainer.addEventListener('mousemove', drag);
    
    // Touch events for mobile
    imageContainer.addEventListener('touchstart', dragStart);
    imageContainer.addEventListener('touchend', dragEnd);
    imageContainer.addEventListener('touchmove', drag);

    // Mouse leave event
    imageContainer.addEventListener('mouseleave', function() {
        if (!isDragging) return;
        dragEnd();
    });

    // Parallax on mouse move (subtle effect)
    imageContainer.addEventListener('mousemove', function(e) {
        if (isDragging) return;
        
        const rect = imageContainer.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateY = ((x - centerX) / centerX) * 5;
        const rotateX = ((centerY - y) / centerY) * 5;
        
        imageContainer.style.transform = `perspective(1500px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        image.style.transform = `scale(${1.05 + (Math.abs(rotateY) * 0.005)})`;
    });

    // Reset on mouse leave
    imageContainer.addEventListener('mouseleave', function() {
        if (isDragging) return;
        imageContainer.style.transform = 'perspective(1500px) rotateX(0) rotateY(0)';
        image.style.transform = 'scale(1.05)';
    });

    // Drag functions
    function dragStart(e) {
        e.preventDefault();
        isDragging = true;
        
        if (e.type === 'touchstart') {
            initialX = e.touches[0].clientX - xOffset;
            initialY = e.touches[0].clientY - yOffset;
        } else {
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;
        }
        
        imageContainer.style.cursor = 'grabbing';
        imageContainer.style.transition = 'transform 0.1s ease-out';
    }

    function dragEnd() {
        isDragging = false;
        initialX = currentX;
        initialY = currentY;
        
        imageContainer.style.cursor = 'grab';
        imageContainer.style.transition = 'transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        imageContainer.style.transform = 'perspective(1500px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
        image.style.transform = 'scale(1.05)';
        
        // Animate back to center
        setTimeout(() => {
            xOffset = 0;
            yOffset = 0;
        }, 600);
    }

    function drag(e) {
        if (!isDragging) return;
        e.preventDefault();

        if (e.type === 'touchmove') {
            currentX = e.touches[0].clientX - initialX;
            currentY = e.touches[0].clientY - initialY;
        } else {
            currentX = e.clientX - initialX;
            currentY = e.clientY - initialY;
        }

        xOffset = currentX;
        yOffset = currentY;

        // Calculate rotation based on drag
        const maxRotate = 20;
        const rotateY = (currentX / imageContainer.offsetWidth) * maxRotate * 2;
        const rotateX = -(currentY / imageContainer.offsetHeight) * maxRotate;
        
        // Calculate zoom based on drag intensity
        const dragIntensity = Math.sqrt(currentX * currentX + currentY * currentY);
        const maxIntensity = 100;
        const zoom = 1.05 + Math.min(dragIntensity / maxIntensity * 0.2, 0.2);

        imageContainer.style.transform = `perspective(1500px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(${zoom}, ${zoom}, ${zoom})`;
        image.style.transform = `scale(${zoom * 1.05})`;
    }

    // Click to zoom effect
    imageContainer.addEventListener('click', function(e) {
        if (isDragging) return;
        
        imageContainer.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        imageContainer.style.transform = 'perspective(1500px) rotateX(0) rotateY(0) scale3d(1.15, 1.15, 1.15)';
        
        setTimeout(() => {
            imageContainer.style.transition = 'all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            imageContainer.style.transform = 'perspective(1500px) rotateX(0) rotateY(0) scale3d(1.02, 1.02, 1.02)';
        }, 400);
    });
});
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<!-- Responsive Design -->
<style>
    @media (max-width: 992px) {
        .product-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .product-title {
            font-size: 2rem;
        }
        
        .price-tag {
            font-size: 2.25rem;
            padding: 1rem 2rem;
        }
        
        .image-container {
            height: 400px;
        }
        
        .floating-badge {
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 768px) {
        .product-card {
            padding: 1.5rem;
            border-radius: 20px;
        }
        
        .product-title {
            font-size: 1.75rem;
        }
        
        .price-tag {
            font-size: 2rem;
            padding: 0.75rem 1.5rem;
        }
        
        .btn-yellow {
            padding: 1rem 2rem;
            font-size: 1rem;
        }
        
        .image-container {
            height: 300px;
        }
        
        .long-description {
            padding: 1.5rem;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .product-card {
            padding: 1rem;
        }
        
        .image-container {
            height: 250px;
        }
        
        .product-highlight {
            display: block;
            margin-right: 0;
            margin-bottom: 0.5rem;
        }
    }
</style>

@endsection
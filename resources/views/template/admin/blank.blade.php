@extends('template.layouts.admin')

@section('title', 'Blank Page')

@section('breadcrumb')
<span class="breadcrumb-current">Blank Page</span>
@endsection

@section('styles')
<style>
    /* Custom styles untuk halaman ini */
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -50px;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        bottom: -80px;
        left: -50px;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-icon {
        font-size: 48px;
        margin-bottom: 16px;
    }

    .welcome-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .welcome-text {
        font-size: 16px;
        opacity: 0.9;
        line-height: 1.6;
        max-width: 600px;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 32px;
    }

    @media (max-width: 1024px) {
        .feature-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .feature-grid {
            grid-template-columns: 1fr;
        }
    }

    .feature-item {
        background: white;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        width: 48px;
        height: 48px;
        background: #f3e8ff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .feature-content h3 {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .feature-content p {
        font-size: 14px;
        color: #64748b;
        line-height: 1.5;
    }

    /* Quick Actions */
    .quick-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
        flex-wrap: wrap;
    }

    .quick-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        color: white;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .quick-action-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
    }

    /* Code Block */
    .code-block {
        background: #1e293b;
        border-radius: 12px;
        padding: 20px;
        overflow-x: auto;
    }

    .code-block pre {
        margin: 0;
        font-family: 'Fira Code', 'Consolas', monospace;
        font-size: 13px;
        line-height: 1.6;
        color: #e2e8f0;
    }

    .code-block .comment {
        color: #64748b;
    }

    .code-block .keyword {
        color: #c084fc;
    }

    .code-block .string {
        color: #86efac;
    }

    .code-block .variable {
        color: #7dd3fc;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">Blank Page Template</h1>
        <p class="page-subtitle">Halaman kosong untuk pengembangan fitur baru</p>
    </div>

    <!-- Welcome Card -->
    <div class="welcome-card">
        <div class="welcome-content">
            <div class="welcome-icon">🎨</div>
            <h2 class="welcome-title">Selamat Datang di Template Blank Page!</h2>
            <p class="welcome-text">
                Gunakan halaman ini sebagai titik awal untuk mengembangkan fitur-fitur baru. 
                Template ini sudah terintegrasi dengan layout admin dan siap untuk dikustomisasi sesuai kebutuhan.
            </p>
            <div class="quick-actions">
                <a href="{{ url('/admin/forms') }}" class="quick-action-btn">
                    📝 Lihat Form Components
                </a>
                <a href="{{ url('/admin/tables') }}" class="quick-action-btn">
                    📋 Lihat Table Components
                </a>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="feature-grid">
        <div class="feature-item">
            <div class="feature-icon">🧩</div>
            <div class="feature-content">
                <h3>Modular Components</h3>
                <p>Komponen yang dapat digunakan ulang untuk mempercepat pengembangan.</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">📱</div>
            <div class="feature-content">
                <h3>Responsive Design</h3>
                <p>Layout yang responsif dan optimal di semua ukuran layar.</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">🎯</div>
            <div class="feature-content">
                <h3>Clean Code</h3>
                <p>Kode yang bersih dan terstruktur untuk kemudahan maintenance.</p>
            </div>
        </div>
    </div>

    <!-- Usage Guide Card -->
    <div class="card mt-4">
        <div class="card-header">
            <h2 class="card-title">📖 Cara Menggunakan Template</h2>
        </div>
        <div class="card-body">
            <p class="mb-3" style="color: #64748b;">
                Untuk membuat halaman baru, buat file Blade di <code>resources/views/admin/</code> dan extend layout admin:
            </p>
            <div class="code-block">
                <pre><span class="comment">@{{-- resources/views/admin/nama-halaman.blade.php --}}</span>

    <span class="keyword">@@extends</span>(<span class="string">'layouts.admin'</span>)

    <span class="keyword">@@section</span>(<span class="string">'title'</span>, <span class="string">'Judul Halaman'</span>)

    <span class="keyword">@@section</span>(<span class="string">'breadcrumb'</span>)
    <span class="variable">&lt;span class="breadcrumb-current"&gt;</span>Nama Halaman<span class="variable">&lt;/span&gt;</span>
    <span class="keyword">@@endsection</span>

    <span class="keyword">@@section</span>(<span class="string">'styles'</span>)
    <span class="variable">&lt;style&gt;</span>
        <span class="comment">/* Custom CSS untuk halaman ini */</span>
    <span class="variable">&lt;/style&gt;</span>
    <span class="keyword">@@endsection</span>

    <span class="keyword">@@section</span>(<span class="string">'content'</span>)
    <span class="variable">&lt;div class="page-header"&gt;</span>
        <span class="variable">&lt;h1 class="page-title"&gt;</span>Judul Halaman<span class="variable">&lt;/h1&gt;</span>
        <span class="variable">&lt;p class="page-subtitle"&gt;</span>Deskripsi halaman<span class="variable">&lt;/p&gt;</span>
    <span class="variable">&lt;/div&gt;</span>

    <span class="variable">&lt;div class="card"&gt;</span>
        <span class="variable">&lt;div class="card-header"&gt;</span>
            <span class="variable">&lt;h2 class="card-title"&gt;</span>Judul Card<span class="variable">&lt;/h2&gt;</span>
        <span class="variable">&lt;/div&gt;</span>
        <span class="variable">&lt;div class="card-body"&gt;</span>
            <span class="comment">&lt;!-- Konten halaman --&gt;</span>
        <span class="variable">&lt;/div&gt;</span>
    <span class="variable">&lt;/div&gt;</span>
    <span class="keyword">@@endsection</span>

    <span class="keyword">@@section</span>(<span class="string">'scripts'</span>)
    <span class="variable">&lt;script&gt;</span>
        <span class="comment">// Custom JavaScript</span>
    <span class="variable">&lt;/script&gt;</span>
    <span class="keyword">@@endsection</span></pre>
            </div>
        </div>
    </div>

    <!-- Available Sections -->
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">📦 Section yang Tersedia</h2>
        </div>
        <div class="card-body">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 12px; text-align: left; color: #64748b; font-size: 12px; text-transform: uppercase;">Section</th>
                        <th style="padding: 12px; text-align: left; color: #64748b; font-size: 12px; text-transform: uppercase;">Deskripsi</th>
                        <th style="padding: 12px; text-align: left; color: #64748b; font-size: 12px; text-transform: uppercase;">Required</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 12px;"><code>@@section('title')</code></td>
                        <td style="padding: 12px; color: #64748b;">Judul halaman (ditampilkan di tab browser)</td>
                        <td style="padding: 12px;"><span style="color: #10b981;">Optional</span></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 12px;"><code>@@section('breadcrumb')</code></td>
                        <td style="padding: 12px; color: #64748b;">Breadcrumb navigation di header</td>
                        <td style="padding: 12px;"><span style="color: #10b981;">Optional</span></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 12px;"><code>@@section('styles')</code></td>
                        <td style="padding: 12px; color: #64748b;">CSS khusus untuk halaman</td>
                        <td style="padding: 12px;"><span style="color: #10b981;">Optional</span></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 12px;"><code>@@section('content')</code></td>
                        <td style="padding: 12px; color: #64748b;">Konten utama halaman</td>
                        <td style="padding: 12px;"><span style="color: #ef4444;">Required</span></td>
                    </tr>
                    <tr>
                        <td style="padding: 12px;"><code>@@section('scripts')</code></td>
                        <td style="padding: 12px; color: #64748b;">JavaScript khusus untuk halaman</td>
                        <td style="padding: 12px;"><span style="color: #10b981;">Optional</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- CSS Classes -->
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">🎨 CSS Classes yang Tersedia</h2>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                <div>
                    <h4 style="font-size: 14px; font-weight: 600; color: #1e293b; margin-bottom: 12px;">Layout</h4>
                    <ul style="list-style: none; font-size: 14px; color: #64748b; line-height: 2;">
                        <li><code>.card</code> - Container card</li>
                        <li><code>.card-header</code> - Header card</li>
                        <li><code>.card-body</code> - Body card</li>
                        <li><code>.card-footer</code> - Footer card</li>
                        <li><code>.page-header</code> - Header halaman</li>
                    </ul>
                </div>
                <div>
                    <h4 style="font-size: 14px; font-weight: 600; color: #1e293b; margin-bottom: 12px;">Typography</h4>
                    <ul style="list-style: none; font-size: 14px; color: #64748b; line-height: 2;">
                        <li><code>.page-title</code> - Judul halaman</li>
                        <li><code>.page-subtitle</code> - Subtitle halaman</li>
                        <li><code>.card-title</code> - Judul card</li>
                        <li><code>.text-muted</code> - Teks abu-abu</li>
                    </ul>
                </div>
                <div>
                    <h4 style="font-size: 14px; font-weight: 600; color: #1e293b; margin-bottom: 12px;">Spacing</h4>
                    <ul style="list-style: none; font-size: 14px; color: #64748b; line-height: 2;">
                        <li><code>.mb-0</code> s/d <code>.mb-4</code> - Margin bottom</li>
                        <li><code>.mt-0</code> s/d <code>.mt-4</code> - Margin top</li>
                        <li><code>.gap-1</code>, <code>.gap-2</code> - Gap flex/grid</li>
                    </ul>
                </div>
                <div>
                    <h4 style="font-size: 14px; font-weight: 600; color: #1e293b; margin-bottom: 12px;">Utilities</h4>
                    <ul style="list-style: none; font-size: 14px; color: #64748b; line-height: 2;">
                        <li><code>.d-flex</code> - Display flex</li>
                        <li><code>.align-center</code> - Align items center</li>
                        <li><code>.justify-between</code> - Justify space-between</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Custom JavaScript untuk halaman ini
        console.log('Blank page loaded!');
    </script>
@endsection

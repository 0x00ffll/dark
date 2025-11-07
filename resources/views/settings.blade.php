@extends('layouts.app')

@section('title', 'Settings - VENOM IPTV Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">System Settings</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">General Settings</button>
                            <button class="nav-link" id="v-pills-server-tab" data-bs-toggle="pill" data-bs-target="#v-pills-server" type="button" role="tab" aria-controls="v-pills-server" aria-selected="false">Server Settings</button>
                            <button class="nav-link" id="v-pills-streaming-tab" data-bs-toggle="pill" data-bs-target="#v-pills-streaming" type="button" role="tab" aria-controls="v-pills-streaming" aria-selected="false">Streaming Settings</button>
                            <button class="nav-link" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security" type="button" role="tab" aria-controls="v-pills-security" aria-selected="false">Security Settings</button>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <!-- General Settings -->
                            <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                                <div class="card shadow-none border">
                                    <div class="card-body">
                                        <h6 class="mb-4">General Configuration</h6>
                                        
                                        <form>
                                            <div class="row mb-3">
                                                <label for="site_name" class="col-sm-3 col-form-label">Site Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="site_name" value="VENOM IPTV">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="site_url" class="col-sm-3 col-form-label">Site URL</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="site_url" value="https://venomiptv.com">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="admin_email" class="col-sm-3 col-form-label">Admin Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="admin_email" value="admin@venomiptv.com">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="timezone" class="col-sm-3 col-form-label">Timezone</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" id="timezone">
                                                        <option value="UTC">UTC</option>
                                                        <option value="America/New_York" selected>America/New_York</option>
                                                        <option value="Europe/London">Europe/London</option>
                                                        <option value="Asia/Tokyo">Asia/Tokyo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-9 offset-sm-3">
                                                    <button type="submit" class="btn btn-primary">Save Settings</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Server Settings -->
                            <div class="tab-pane fade" id="v-pills-server" role="tabpanel" aria-labelledby="v-pills-server-tab">
                                <div class="card shadow-none border">
                                    <div class="card-body">
                                        <h6 class="mb-4">Server Configuration</h6>
                                        
                                        <form>
                                            <div class="row mb-3">
                                                <label for="max_connections" class="col-sm-3 col-form-label">Max Connections</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="max_connections" value="1000">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="max_bandwidth" class="col-sm-3 col-form-label">Max Bandwidth (Mbps)</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="max_bandwidth" value="1000">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="load_balancer" class="col-sm-3 col-form-label">Load Balancer</label>
                                                <div class="col-sm-9">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="load_balancer" checked>
                                                        <label class="form-check-label" for="load_balancer">Enable Load Balancing</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-9 offset-sm-3">
                                                    <button type="submit" class="btn btn-primary">Save Settings</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Streaming Settings -->
                            <div class="tab-pane fade" id="v-pills-streaming" role="tabpanel" aria-labelledby="v-pills-streaming-tab">
                                <div class="card shadow-none border">
                                    <div class="card-body">
                                        <h6 class="mb-4">Streaming Configuration</h6>
                                        
                                        <form>
                                            <div class="row mb-3">
                                                <label for="stream_quality" class="col-sm-3 col-form-label">Default Quality</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" id="stream_quality">
                                                        <option value="720p">720p HD</option>
                                                        <option value="1080p" selected>1080p Full HD</option>
                                                        <option value="4k">4K Ultra HD</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="buffer_size" class="col-sm-3 col-form-label">Buffer Size (seconds)</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="buffer_size" value="5">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="adaptive_streaming" class="col-sm-3 col-form-label">Adaptive Streaming</label>
                                                <div class="col-sm-9">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="adaptive_streaming" checked>
                                                        <label class="form-check-label" for="adaptive_streaming">Enable Adaptive Bitrate</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-9 offset-sm-3">
                                                    <button type="submit" class="btn btn-primary">Save Settings</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Security Settings -->
                            <div class="tab-pane fade" id="v-pills-security" role="tabpanel" aria-labelledby="v-pills-security-tab">
                                <div class="card shadow-none border">
                                    <div class="card-body">
                                        <h6 class="mb-4">Security Configuration</h6>
                                        
                                        <form>
                                            <div class="row mb-3">
                                                <label for="two_factor" class="col-sm-3 col-form-label">Two Factor Auth</label>
                                                <div class="col-sm-9">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="two_factor">
                                                        <label class="form-check-label" for="two_factor">Enable 2FA</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="session_timeout" class="col-sm-3 col-form-label">Session Timeout (minutes)</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="session_timeout" value="60">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="ip_whitelist" class="col-sm-3 col-form-label">IP Whitelist</label>
                                                <div class="col-sm-9">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="ip_whitelist">
                                                        <label class="form-check-label" for="ip_whitelist">Enable IP Restrictions</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-9 offset-sm-3">
                                                    <button type="submit" class="btn btn-primary">Save Settings</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection